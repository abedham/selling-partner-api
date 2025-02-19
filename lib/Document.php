<?php

namespace SellingPartnerApi;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PhpOffice\PhpSpreadsheet\IOFactory;
use RuntimeException;

use SellingPartnerApi\Model\FeedsV20210630\CreateFeedDocumentResponse;
use SellingPartnerApi\Model\FeedsV20210630\FeedDocument;
use SellingPartnerApi\Model\ReportsV20210630\ReportDocument;

class Document
{
    public const ENCRYPTION_SCHEME = "AES-256-CBC";

    private $url;
    private $compressionAlgo;
    private $contentType;
    private $data;
    private $tmpFilename;
    private $client;

    public $successfulFeedRecords = null;
    public $failedFeedRecords = null;

    /**
     * @param Model\Reports\ReportDocument|Model\Feeds\FeedDocument|Model\Feeds\CreateFeedDocumentResponse $documentInfo
     *      The payload of a successful call to getReportDocument, createFeedDocument, or getFeedDocument
     * @param ?array['contentType' => string, 'name' => string] $documentType
     *      Must be one of the constants defined in the ReportType or FeedType classes. When downloading a feed
     *      result document, pass the FeedType constant corresponding to the feed type that produced the result document..
     * @param ?\GuzzleHttp\Client $client  The Guzzle client to use. If not provided, a new one will be created.
     */
    public function __construct(
        object $documentInfo,
        ?array $documentType = ReportType::__FEED_RESULT_REPORT,  // $documentType will be required in the next major version
        ?Client $client = null
    ) {
        // Make sure $documentInfo is a valid type
        if (!(
            $documentInfo instanceof ReportDocument ||
            $documentInfo instanceof FeedDocument ||
            $documentInfo instanceof CreateFeedDocumentResponse
        )) {
            $msg = "documentInfo must be one of the following types: Model\Feeds\CreateFeedDocumentResponse, Model\Feeds\FeedDocument, Model\Reports\ReportDocument";
            throw new RuntimeException($msg);
        }

        if ($documentType === null) {
            throw new RuntimeException('$documentType cannot be null');
        } else if ($documentType === ReportType::__FEED_RESULT_REPORT) {
            echo 'ReportType::__FEED_RESULT_REPORT is deprecated, and may not result in a properly parsed feed result document.';
            echo 'Please pass the feed type constant for the feed whose result document is being parsed (e.g., FeedType::POST_PRODUCT_DATA.';
        }

        $this->contentType = $documentType['contentType'];

        $validContentTypes = ContentType::getContentTypes();
        if (!in_array($this->contentType, array_values($validContentTypes))) {
            $readableContentTypes = [];
            foreach ($validContentTypes as $name => $value) {
                $readableContentTypes[] = "SellingPartnerApi\ContentType::{$name} ($value)";
            }
            throw new \InvalidArgumentException("Valid content types are: " . implode(", ", $readableContentTypes));
        }

        $this->url = $documentInfo->getUrl();

        if (method_exists($documentInfo, "getCompressionAlgorithm")) {
            $this->compressionAlgo = $documentInfo->getCompressionAlgorithm() ?? null;
        }

        $this->client = $client ?? new Client();
    }

    /**
     * Downloads the document data, and optionally parses it into a different format based on its content type.
     *
     * @param ?bool $postProcess If true, parse document contents based on the document's content type.
     *      CSV or TAB: a 2D array of (associative) report rows
     *      JSON: a nested array of data (result of json_decode)
     *      PDF or PLAIN: the raw, unmodified document contents
     *      XLSX: a PhpOffice\PhpSpreadsheet\Spreadsheet object
     *      XML: a SimpleXML object
     * @param ?string $encoding Pass specific $from_encoding to mb_convert_encoding funtion. If not provided,
     *      try to automatically detect and use the encoding from the http response, otherwise internal mbstring encoding is used
     *
     * @return string The raw (unencrypted) document contents.
     */
    public function download(?bool $postProcess = true, ?string $encoding = null): string {
        try {
            $response = $this->client->request('GET', $this->url, ['stream' => true]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            if ($response->getStatusCode() == 404) {
                throw new RuntimeException("Document Report not Found ({$response->getStatusCode()}): {$response->getBody()}");
            } else {
                throw $e;
            }
        }
        
        $rawContents = $response->getBody()->getContents();

        $contents = null;
        if ($this->compressionAlgo !== null && $this->compressionAlgo === "GZIP") {
            $contents = gzdecode($rawContents);
        } else {
            $contents = $rawContents;
        }

        // Don't try to parse report data. Useful for very large reports, or if someone
        // wants to do custom parsing
        if (!$postProcess) {
            $this->data = $contents;
            return $contents;
        }

        // Document encodings depend on the target marketplace. English-language reports are
        // typically ISO-8859-1 encoded, which messes up the data when we read it directly via
        // SimpleXML or as a plain TAB/CSV, but the original encoding is required to parse XLSX
        // and PDF reports.
        // If encoding is not provided try to automatically detect the encoding from the http response; default is UTF-8
        if (!($this->contentType === ContentType::XLSX || $this->contentType === ContentType::PDF)) {
            if (!is_null($encoding) && !in_array(strtoupper($encoding), mb_list_encodings())) {
                $encoding = null;
            } else {
                $encodings = ['UTF-8'];
                if ($response->hasHeader('content-type')) {
                    $httpContentType = $response->getHeader('content-type');
                    $parsedHeader = \GuzzleHttp\Psr7\Header::parse($httpContentType);
                    if (isset($parsedHeader[0]['charset'])) {
                        array_unshift($encodings, $parsedHeader[0]['charset']);
                    }
                }
                $encoding = mb_detect_encoding($contents, $encodings, true);
            }
            $contents = mb_convert_encoding($contents, "UTF-8", $encoding ?? mb_internal_encoding());
        }

        $this->tmpFilename = tempnam(sys_get_temp_dir(), "tempdoc_spapi");

        if (in_array($this->contentType, [ContentType::TAB, ContentType::CSV, ContentType::XLSX])) {
            $tempFile = fopen($this->tmpFilename, "r+");
            fwrite($tempFile, $contents);
            fclose($tempFile);
            $fileType = IOFactory::identify($this->tmpFilename);
            $reader = IOFactory::createReader($fileType);
        }

        switch ($this->contentType) {
            case ContentType::TAB:
                // Amazon doesn't use enclosure characters, and passing an empty string to setEnclosure
                // results in the default enclosure being used (a double quote character), so we use a
                // bizarre character to avoid recognizing double quotes as enclosures.
                // Thanks @gregordonsky (https://github.com/gregordonsky) for the idea!
                $reader->setEnclosure(chr(8));
            case ContentType::CSV:
            case ContentType::XLSX:
                $spreadsheet = IOFactory::load($this->tmpFilename);
                if ($this->contentType !== ContentType::XLSX) {
                    $sheet = $spreadsheet->getSheet(0)->toArray();
                    // Turn each row of data into an associative array with the headers as keys
                    array_walk($sheet, function(&$row) use ($sheet) {
                        $row = array_combine($sheet[0], $row);
                    });
                    // Remove headers line
                    array_shift($sheet);
                    $this->data = $sheet;
                } else {
                    $this->data = $spreadsheet;
                }
                unlink($this->tmpFilename);
                break;
            case ContentType::JSON:
                $this->data = json_decode($contents, true);
                break;
            case ContentType::PDF:
            case ContentType::PLAIN:
                $this->data = $contents;
                break;
            case ContentType::XML:
                $this->data = simplexml_load_string($contents);
                break;               
        }

        return $contents;
    }

    /**
     * Uploads data to the document specified in the constructor.
     *
     * @param string $feedData The contents of the feed to be uploaded
     *
     * @return void
     */
    public function upload(string $feedData): void {
        $response = $this->client->put($this->url, [
            RequestOptions::HEADERS => [
                "content-type" => $this->contentType,
                "host" => parse_url($this->url, PHP_URL_HOST),
            ],
            RequestOptions::BODY => $feedData,
        ]);

        if ($response->getStatusCode() >= 300) {
            throw new RuntimeException("Upload failed ({$response->getStatusCode()}): {$response->getBody()}");
        }
    }

    public function getData() {
        return isset($this->data) ? $this->data : false;
    }

    public function __destruct() {
        if (isset($this->tempFilename)) {
            unlink($this->tempFilename);
        }
    }
}

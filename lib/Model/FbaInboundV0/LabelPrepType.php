<?php
/**
 * LabelPrepType
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  SellingPartnerApi
 */

/**
 * Selling Partner API for Fulfillment Inbound
 *
 * The Selling Partner API for Fulfillment Inbound lets you create applications that create and update inbound shipments of inventory to Amazon's fulfillment network.
 *
 * The version of the OpenAPI document: v0
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.0.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace SellingPartnerApi\Model\FbaInboundV0;
use \SellingPartnerApi\ObjectSerializer;
use \SellingPartnerApi\Model\ModelInterface;

/**
 * LabelPrepType Class Doc Comment
 *
 * @category Class
 * @description The type of label preparation that is required for the inbound shipment.
 * @package  SellingPartnerApi
 * @group 
 */
class LabelPrepType
{
    /**
     * Possible values of this enum
     */
    const NO_LABEL = 'NO_LABEL';
    const SELLER_LABEL = 'SELLER_LABEL';
    const AMAZON_LABEL = 'AMAZON_LABEL';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::NO_LABEL,
            self::SELLER_LABEL,
            self::AMAZON_LABEL,
        ];
    }
}



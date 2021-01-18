<?php
/**
 * GetFulfillmentPreviewRequest
 *
 * PHP version 5
 *
 * @category Class
 * @package  Evers\SellingPartnerApi
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Selling Partner APIs for Fulfillment Outbound
 *
 * The Selling Partner API for Fulfillment Outbound lets you create applications that help a seller fulfill Multi-Channel Fulfillment orders using their inventory in Amazon's fulfillment network. You can get information on both potential and existing fulfillment orders.
 *
 * OpenAPI spec version: 2020-07-01
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.18
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Evers\SellingPartnerApi\Model;

use \ArrayAccess;
use \Evers\SellingPartnerApi\ObjectSerializer;

/**
 * GetFulfillmentPreviewRequest Class Doc Comment
 *
 * @category Class
 * @description The request body schema for the getFulfillmentPreview operation.
 * @package  Evers\SellingPartnerApi
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetFulfillmentPreviewRequest implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'GetFulfillmentPreviewRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'marketplace_id' => 'string',
        'address' => '\Evers\SellingPartnerApi\Model\Address',
        'items' => '\Evers\SellingPartnerApi\Model\GetFulfillmentPreviewItemList',
        'shipping_speed_categories' => '\Evers\SellingPartnerApi\Model\ShippingSpeedCategoryList',
        'include_cod_fulfillment_preview' => 'bool',
        'include_delivery_windows' => 'bool',
        'feature_constraints' => '\Evers\SellingPartnerApi\Model\FeatureSettings[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'marketplace_id' => null,
        'address' => null,
        'items' => null,
        'shipping_speed_categories' => null,
        'include_cod_fulfillment_preview' => null,
        'include_delivery_windows' => null,
        'feature_constraints' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'marketplace_id' => 'marketplaceId',
        'address' => 'address',
        'items' => 'items',
        'shipping_speed_categories' => 'shippingSpeedCategories',
        'include_cod_fulfillment_preview' => 'includeCODFulfillmentPreview',
        'include_delivery_windows' => 'includeDeliveryWindows',
        'feature_constraints' => 'featureConstraints'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'marketplace_id' => 'setMarketplaceId',
        'address' => 'setAddress',
        'items' => 'setItems',
        'shipping_speed_categories' => 'setShippingSpeedCategories',
        'include_cod_fulfillment_preview' => 'setIncludeCodFulfillmentPreview',
        'include_delivery_windows' => 'setIncludeDeliveryWindows',
        'feature_constraints' => 'setFeatureConstraints'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'marketplace_id' => 'getMarketplaceId',
        'address' => 'getAddress',
        'items' => 'getItems',
        'shipping_speed_categories' => 'getShippingSpeedCategories',
        'include_cod_fulfillment_preview' => 'getIncludeCodFulfillmentPreview',
        'include_delivery_windows' => 'getIncludeDeliveryWindows',
        'feature_constraints' => 'getFeatureConstraints'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['marketplace_id'] = isset($data['marketplace_id']) ? $data['marketplace_id'] : null;
        $this->container['address'] = isset($data['address']) ? $data['address'] : null;
        $this->container['items'] = isset($data['items']) ? $data['items'] : null;
        $this->container['shipping_speed_categories'] = isset($data['shipping_speed_categories']) ? $data['shipping_speed_categories'] : null;
        $this->container['include_cod_fulfillment_preview'] = isset($data['include_cod_fulfillment_preview']) ? $data['include_cod_fulfillment_preview'] : null;
        $this->container['include_delivery_windows'] = isset($data['include_delivery_windows']) ? $data['include_delivery_windows'] : null;
        $this->container['feature_constraints'] = isset($data['feature_constraints']) ? $data['feature_constraints'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['address'] === null) {
            $invalidProperties[] = "'address' can't be null";
        }
        if ($this->container['items'] === null) {
            $invalidProperties[] = "'items' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets marketplace_id
     *
     * @return string
     */
    public function getMarketplaceId()
    {
        return $this->container['marketplace_id'];
    }

    /**
     * Sets marketplace_id
     *
     * @param string $marketplace_id The marketplace the fulfillment order is placed against.
     *
     * @return $this
     */
    public function setMarketplaceId($marketplace_id)
    {
        $this->container['marketplace_id'] = $marketplace_id;

        return $this;
    }

    /**
     * Gets address
     *
     * @return \Evers\SellingPartnerApi\Model\Address
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param \Evers\SellingPartnerApi\Model\Address $address The destination address for the fulfillment order preview.
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets items
     *
     * @return \Evers\SellingPartnerApi\Model\GetFulfillmentPreviewItemList
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items
     *
     * @param \Evers\SellingPartnerApi\Model\GetFulfillmentPreviewItemList $items Identifying information and quantity information for the items in the fulfillment order preview.
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->container['items'] = $items;

        return $this;
    }

    /**
     * Gets shipping_speed_categories
     *
     * @return \Evers\SellingPartnerApi\Model\ShippingSpeedCategoryList
     */
    public function getShippingSpeedCategories()
    {
        return $this->container['shipping_speed_categories'];
    }

    /**
     * Sets shipping_speed_categories
     *
     * @param \Evers\SellingPartnerApi\Model\ShippingSpeedCategoryList $shipping_speed_categories A list of shipping methods used for creating fulfillment order previews.  Possible values:  * Standard - Standard shipping method. * Expedited - Expedited shipping method. * Priority - Priority shipping method. * ScheduledDelivery - Scheduled Delivery shipping method. Note: Shipping method service level agreements vary by marketplace. Sellers should see the Seller Central website in their marketplace for shipping method service level agreements and fulfillment fees.
     *
     * @return $this
     */
    public function setShippingSpeedCategories($shipping_speed_categories)
    {
        $this->container['shipping_speed_categories'] = $shipping_speed_categories;

        return $this;
    }

    /**
     * Gets include_cod_fulfillment_preview
     *
     * @return bool
     */
    public function getIncludeCodFulfillmentPreview()
    {
        return $this->container['include_cod_fulfillment_preview'];
    }

    /**
     * Sets include_cod_fulfillment_preview
     *
     * @param bool $include_cod_fulfillment_preview Specifies whether to return fulfillment order previews that are for COD (Cash On Delivery).  Possible values:  * true - Returns all fulfillment order previews (both for COD and not for COD). * false - Returns only fulfillment order previews that are not for COD.
     *
     * @return $this
     */
    public function setIncludeCodFulfillmentPreview($include_cod_fulfillment_preview)
    {
        $this->container['include_cod_fulfillment_preview'] = $include_cod_fulfillment_preview;

        return $this;
    }

    /**
     * Gets include_delivery_windows
     *
     * @return bool
     */
    public function getIncludeDeliveryWindows()
    {
        return $this->container['include_delivery_windows'];
    }

    /**
     * Sets include_delivery_windows
     *
     * @param bool $include_delivery_windows Specifies whether to return the ScheduledDeliveryInfo response object, which contains the available delivery windows for a Scheduled Delivery. The ScheduledDeliveryInfo response object can only be returned for fulfillment order previews with ShippingSpeedCategories = ScheduledDelivery.
     *
     * @return $this
     */
    public function setIncludeDeliveryWindows($include_delivery_windows)
    {
        $this->container['include_delivery_windows'] = $include_delivery_windows;

        return $this;
    }

    /**
     * Gets feature_constraints
     *
     * @return \Evers\SellingPartnerApi\Model\FeatureSettings[]
     */
    public function getFeatureConstraints()
    {
        return $this->container['feature_constraints'];
    }

    /**
     * Sets feature_constraints
     *
     * @param \Evers\SellingPartnerApi\Model\FeatureSettings[] $feature_constraints A list of features and their fulfillment policies to apply to the order.
     *
     * @return $this
     */
    public function setFeatureConstraints($feature_constraints)
    {
        $this->container['feature_constraints'] = $feature_constraints;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}



<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-fba
 */
enum Concessions: string implements ReportOptions
{
    case GET_FBA_FULFILLMENT_CUSTOMER_RETURNS_DATA = 'GET_FBA_FULFILLMENT_CUSTOMER_RETURNS_DATA';
    case GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_REPLACEMENT_DATA = 'GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_REPLACEMENT_DATA';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_FBA_FULFILLMENT_CUSTOMER_RETURNS_DATA,
            self::GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_REPLACEMENT_DATA,
        ];
    }

    /**
     * @return array
     */
    public function getReportOptions(): array
    {
        return [];
    }
}

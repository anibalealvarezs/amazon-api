<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-fba
 */
enum Removals: string implements ReportOptions
{
    case GET_FBA_RECOMMENDED_REMOVAL_DATA = 'GET_FBA_RECOMMENDED_REMOVAL_DATA';
    case GET_FBA_FULFILLMENT_REMOVAL_ORDER_DETAIL_DATA = 'GET_FBA_FULFILLMENT_REMOVAL_ORDER_DETAIL_DATA';
    case GET_FBA_FULFILLMENT_REMOVAL_SHIPMENT_DETAIL_DATA = 'GET_FBA_FULFILLMENT_REMOVAL_SHIPMENT_DETAIL_DATA';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_FBA_RECOMMENDED_REMOVAL_DATA,
            self::GET_FBA_FULFILLMENT_REMOVAL_ORDER_DETAIL_DATA,
            self::GET_FBA_FULFILLMENT_REMOVAL_SHIPMENT_DETAIL_DATA,
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

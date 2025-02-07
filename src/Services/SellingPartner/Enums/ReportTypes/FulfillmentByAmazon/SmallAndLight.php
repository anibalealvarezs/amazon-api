<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-fba
 */
enum SmallAndLight: string implements ReportOptions
{
    case GET_FBA_UNO_INVENTORY_DATA = 'GET_FBA_UNO_INVENTORY_DATA';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_FBA_UNO_INVENTORY_DATA,
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

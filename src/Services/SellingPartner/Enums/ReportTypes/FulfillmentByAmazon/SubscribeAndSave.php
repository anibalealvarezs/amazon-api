<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-fba
 */
enum SubscribeAndSave: string implements ReportOptions
{
    case GET_FBA_SNS_FORECAST_DATA = 'GET_FBA_SNS_FORECAST_DATA';
    case GET_FBA_SNS_PERFORMANCE_DATA = 'GET_FBA_SNS_PERFORMANCE_DATA';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_FBA_SNS_FORECAST_DATA,
            self::GET_FBA_SNS_PERFORMANCE_DATA,
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

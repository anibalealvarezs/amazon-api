<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Analytics;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-analytics
 */
enum Seller: string implements ReportOptions
{
    case GET_SALES_AND_TRAFFIC_REPORT = 'GET_SALES_AND_TRAFFIC_REPORT';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_SALES_AND_TRAFFIC_REPORT,
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

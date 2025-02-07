<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Analytics;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-analytics
 */
enum Brand: string implements ReportOptions
{
    case GET_BRAND_ANALYTICS_MARKET_BASKET_REPORT = 'GET_BRAND_ANALYTICS_MARKET_BASKET_REPORT';
    case GET_BRAND_ANALYTICS_SEARCH_TERMS_REPORT = 'GET_BRAND_ANALYTICS_SEARCH_TERMS_REPORT';
    case GET_BRAND_ANALYTICS_REPEAT_PURCHASE_REPORT = 'GET_BRAND_ANALYTICS_REPEAT_PURCHASE_REPORT';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_BRAND_ANALYTICS_MARKET_BASKET_REPORT,
            self::GET_BRAND_ANALYTICS_SEARCH_TERMS_REPORT,
            self::GET_BRAND_ANALYTICS_REPEAT_PURCHASE_REPORT,
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

<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Analytics\Vendor;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-analytics
 */
enum Vendor: string implements ReportOptions
{
    case GET_VENDOR_REAL_TIME_INVENTORY_REPORT = 'GET_VENDOR_REAL_TIME_INVENTORY_REPORT';
    case GET_VENDOR_REAL_TIME_TRAFFIC_REPORT = 'GET_VENDOR_REAL_TIME_TRAFFIC_REPORT';
    case GET_VENDOR_REAL_TIME_SALES_REPORT = 'GET_VENDOR_REAL_TIME_SALES_REPORT';
    case GET_VENDOR_SALES_REPORT = 'GET_VENDOR_SALES_REPORT';
    case GET_VENDOR_NET_PURE_PRODUCT_MARGIN_REPORT = 'GET_VENDOR_NET_PURE_PRODUCT_MARGIN_REPORT';
    case GET_VENDOR_TRAFFIC_REPORT = 'GET_VENDOR_TRAFFIC_REPORT';
    case GET_VENDOR_FORECASTING_REPORT = 'GET_VENDOR_FORECASTING_REPORT';
    case GET_VENDOR_INVENTORY_REPORT = 'GET_VENDOR_INVENTORY_REPORT';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_VENDOR_REAL_TIME_INVENTORY_REPORT,
            self::GET_VENDOR_REAL_TIME_TRAFFIC_REPORT,
            self::GET_VENDOR_REAL_TIME_SALES_REPORT,
            self::GET_VENDOR_SALES_REPORT,
            self::GET_VENDOR_NET_PURE_PRODUCT_MARGIN_REPORT,
            self::GET_VENDOR_TRAFFIC_REPORT,
            self::GET_VENDOR_FORECASTING_REPORT,
            self::GET_VENDOR_INVENTORY_REPORT,
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

<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Order;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-order
 */
enum Order: string implements ReportOptions
{
    case GET_FLAT_FILE_ACTIONABLE_ORDER_DATA_SHIPPING = 'GET_FLAT_FILE_ACTIONABLE_ORDER_DATA_SHIPPING';
    case GET_ORDER_REPORT_DATA_INVOICING = 'GET_ORDER_REPORT_DATA_INVOICING';
    case GET_ORDER_REPORT_DATA_TAX = 'GET_ORDER_REPORT_DATA_TAX';
    case GET_ORDER_REPORT_DATA_SHIPPING = 'GET_ORDER_REPORT_DATA_SHIPPING';
    case GET_FLAT_FILE_ORDER_REPORT_DATA_INVOICING = 'GET_FLAT_FILE_ORDER_REPORT_DATA_INVOICING';
    case GET_FLAT_FILE_ORDER_REPORT_DATA_SHIPPING = 'GET_FLAT_FILE_ORDER_REPORT_DATA_SHIPPING';
    case GET_FLAT_FILE_ORDER_REPORT_DATA_TAX = 'GET_FLAT_FILE_ORDER_REPORT_DATA_TAX';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_FLAT_FILE_ACTIONABLE_ORDER_DATA_SHIPPING,
            self::GET_ORDER_REPORT_DATA_INVOICING,
            self::GET_ORDER_REPORT_DATA_TAX,
            self::GET_ORDER_REPORT_DATA_SHIPPING,
            self::GET_FLAT_FILE_ORDER_REPORT_DATA_INVOICING,
            self::GET_FLAT_FILE_ORDER_REPORT_DATA_SHIPPING,
            self::GET_FLAT_FILE_ORDER_REPORT_DATA_TAX,
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

<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Order;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-order
 */
enum Tracking: string implements ReportOptions
{
    case GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_GENERAL = 'GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_GENERAL';
    case GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_GENERAL = 'GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_GENERAL';
    case GET_FLAT_FILE_ARCHIVED_ORDERS_DATA_BY_ORDER_DATE = 'GET_FLAT_FILE_ARCHIVED_ORDERS_DATA_BY_ORDER_DATE';
    case GET_XML_ALL_ORDERS_DATA_BY_LAST_UPDATE_GENERAL = 'GET_XML_ALL_ORDERS_DATA_BY_LAST_UPDATE_GENERAL';
    case GET_XML_ALL_ORDERS_DATA_BY_ORDER_DATE_GENERAL = 'GET_XML_ALL_ORDERS_DATA_BY_ORDER_DATE_GENERAL';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_GENERAL,
            self::GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_GENERAL,
            self::GET_FLAT_FILE_ARCHIVED_ORDERS_DATA_BY_ORDER_DATE,
            self::GET_XML_ALL_ORDERS_DATA_BY_LAST_UPDATE_GENERAL,
            self::GET_XML_ALL_ORDERS_DATA_BY_ORDER_DATE_GENERAL,
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

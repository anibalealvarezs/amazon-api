<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Order;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-order
 */
enum Pending: string implements ReportOptions
{
    case GET_FLAT_FILE_PENDING_ORDERS_DATA = 'GET_FLAT_FILE_PENDING_ORDERS_DATA';
    case GET_PENDING_ORDERS_DATA = 'GET_PENDING_ORDERS_DATA';
    case GET_CONVERGED_FLAT_FILE_PENDING_ORDERS_DATA = 'GET_CONVERGED_FLAT_FILE_PENDING_ORDERS_DATA';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_FLAT_FILE_PENDING_ORDERS_DATA,
            self::GET_PENDING_ORDERS_DATA,
            self::GET_CONVERGED_FLAT_FILE_PENDING_ORDERS_DATA,
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

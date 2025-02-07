<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\EasyShip;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-easy-ship
 */
enum EasyShip: string implements ReportOptions
{
    case GET_EASYSHIP_DOCUMENTS = 'GET_EASYSHIP_DOCUMENTS';
    case GET_EASYSHIP_PICKEDUP = 'GET_EASYSHIP_PICKEDUP';
    case GET_EASYSHIP_WAITING_FOR_PICKUP = 'GET_EASYSHIP_WAITING_FOR_PICKUP';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_EASYSHIP_DOCUMENTS,
            self::GET_EASYSHIP_PICKEDUP,
            self::GET_EASYSHIP_WAITING_FOR_PICKUP,
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

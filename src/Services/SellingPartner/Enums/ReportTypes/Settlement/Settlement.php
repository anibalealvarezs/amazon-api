<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Settlement;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-settlement
 */
enum Settlement: string implements ReportOptions
{
    case GET_V2_SETTLEMENT_REPORT_DATA_FLAT_FILE = 'GET_V2_SETTLEMENT_REPORT_DATA_FLAT_FILE';
    case GET_V2_SETTLEMENT_REPORT_DATA_XML = 'GET_V2_SETTLEMENT_REPORT_DATA_XML';
    case GET_V2_SETTLEMENT_REPORT_DATA_FLAT_FILE_V2 = 'GET_V2_SETTLEMENT_REPORT_DATA_FLAT_FILE_V2';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_V2_SETTLEMENT_REPORT_DATA_FLAT_FILE,
            self::GET_V2_SETTLEMENT_REPORT_DATA_XML,
            self::GET_V2_SETTLEMENT_REPORT_DATA_FLAT_FILE_V2,
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

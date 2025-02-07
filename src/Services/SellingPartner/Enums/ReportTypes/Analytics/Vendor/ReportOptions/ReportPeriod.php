<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Analytics\Vendor\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-analytics#vendor-retail-analytics-reports
 */
enum ReportPeriod: string
{
    case DAY = 'DAY';
    case WEEK = 'WEEK';
    case MONTH = 'MONTH';
    case QUARTER  = 'QUARTER ';
    case YEAR = 'YEAR';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::DAY,
            self::WEEK,
            self::MONTH,
            self::QUARTER ,
            self::YEAR,
        ];
    }
}

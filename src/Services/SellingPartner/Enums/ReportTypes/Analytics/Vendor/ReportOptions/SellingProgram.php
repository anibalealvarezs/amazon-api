<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Analytics\Vendor\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-analytics#vendor-retail-analytics-reports
 */
enum SellingProgram: string
{
    case RETAIL  = 'RETAIL ';
    case BUSINESS = 'BUSINESS';
    case FRESH = 'FRESH';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::RETAIL ,
            self::BUSINESS,
            self::FRESH,
        ];
    }
}

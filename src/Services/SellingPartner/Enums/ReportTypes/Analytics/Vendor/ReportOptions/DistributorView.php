<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Analytics\Vendor\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-analytics#vendor-retail-analytics-reports
 */
enum DistributorView: string
{
    case MANUFACTURING  = 'MANUFACTURING ';
    case SOURCING  = 'SOURCING ';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::MANUFACTURING ,
            self::SOURCING ,
        ];
    }
}

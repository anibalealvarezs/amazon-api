<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\AmazonBusiness;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-amazon-business
 */
enum AmazonBusiness: string implements ReportOptions
{
    case RFQD_BULK_DOWNLOAD = 'RFQD_BULK_DOWNLOAD';
    case FEE_DISCOUNTS_REPORT = 'FEE_DISCOUNTS_REPORT';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::RFQD_BULK_DOWNLOAD,
            self::FEE_DISCOUNTS_REPORT,
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

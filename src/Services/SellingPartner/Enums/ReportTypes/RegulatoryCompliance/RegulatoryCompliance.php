<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\RegulatoryCompliance;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-regulatory-compliance
 */
enum RegulatoryCompliance: string implements ReportOptions
{
    case MARKETPLACE_ASIN_PAGE_VIEW_METRICS = 'MARKETPLACE_ASIN_PAGE_VIEW_METRICS';
    case GET_EPR_MONTHLY_REPORTS = 'GET_EPR_MONTHLY_REPORTS';
    case GET_EPR_QUARTERLY_REPORTS = 'GET_EPR_QUARTERLY_REPORTS';
    case GET_EPR_ANNUAL_REPORTS = 'GET_EPR_ANNUAL_REPORTS';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::MARKETPLACE_ASIN_PAGE_VIEW_METRICS,
            self::GET_EPR_MONTHLY_REPORTS,
            self::GET_EPR_QUARTERLY_REPORTS,
            self::GET_EPR_ANNUAL_REPORTS,
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

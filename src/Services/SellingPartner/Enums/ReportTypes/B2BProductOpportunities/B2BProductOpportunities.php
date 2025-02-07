<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\B2BProductOpportunities;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-b2b-product-opportunities
 */
enum B2BProductOpportunities: string implements ReportOptions
{
    case GET_B2B_PRODUCT_OPPORTUNITIES_RECOMMENDED_FOR_YOU = 'GET_B2B_PRODUCT_OPPORTUNITIES_RECOMMENDED_FOR_YOU';
    case GET_B2B_PRODUCT_OPPORTUNITIES_NOT_YET_ON_AMAZON = 'GET_B2B_PRODUCT_OPPORTUNITIES_NOT_YET_ON_AMAZON';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_B2B_PRODUCT_OPPORTUNITIES_RECOMMENDED_FOR_YOU,
            self::GET_B2B_PRODUCT_OPPORTUNITIES_NOT_YET_ON_AMAZON,
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

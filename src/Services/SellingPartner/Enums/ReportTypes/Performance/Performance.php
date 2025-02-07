<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Performance;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-performance
 */
enum Performance: string implements ReportOptions
{
    case GET_SELLER_FEEDBACK_DATA = 'GET_SELLER_FEEDBACK_DATA';
    case GET_V1_SELLER_PERFORMANCE_REPORT = 'GET_V1_SELLER_PERFORMANCE_REPORT';
    case GET_V2_SELLER_PERFORMANCE_REPORT = 'GET_V2_SELLER_PERFORMANCE_REPORT';
    case GET_PROMOTION_PERFORMANCE_REPORT = 'GET_PROMOTION_PERFORMANCE_REPORT';
    case GET_COUPON_PERFORMANCE_REPORT = 'GET_COUPON_PERFORMANCE_REPORT';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_SELLER_FEEDBACK_DATA,
            self::GET_V1_SELLER_PERFORMANCE_REPORT,
            self::GET_V2_SELLER_PERFORMANCE_REPORT,
            self::GET_PROMOTION_PERFORMANCE_REPORT,
            self::GET_COUPON_PERFORMANCE_REPORT,
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

<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Inventory;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-inventory
 */
enum Inventory: string implements ReportOptions
{
    case GET_FLAT_FILE_OPEN_LISTINGS_DATA = 'GET_FLAT_FILE_OPEN_LISTINGS_DATA';
    case GET_MERCHANT_LISTINGS_ALL_DATA = 'GET_MERCHANT_LISTINGS_ALL_DATA';
    case GET_MERCHANT_LISTINGS_DATA = 'GET_MERCHANT_LISTINGS_DATA';
    case GET_MERCHANT_LISTINGS_INACTIVE_DATA = 'GET_MERCHANT_LISTINGS_INACTIVE_DATA';
    case GET_MERCHANT_LISTINGS_DATA_BACK_COMPAT = 'GET_MERCHANT_LISTINGS_DATA_BACK_COMPAT';
    case GET_MERCHANT_LISTINGS_DATA_LITE = 'GET_MERCHANT_LISTINGS_DATA_LITE';
    case GET_MERCHANT_LISTINGS_DATA_LITER = 'GET_MERCHANT_LISTINGS_DATA_LITER';
    case GET_MERCHANT_CANCELLED_LISTINGS_DATA = 'GET_MERCHANT_CANCELLED_LISTINGS_DATA';
    case GET_MERCHANTS_LISTINGS_FYP_REPORT = 'GET_MERCHANTS_LISTINGS_FYP_REPORT';
    case GET_PAN_EU_OFFER_STATUS = 'GET_PAN_EU_OFFER_STATUS';
    case GET_MFN_PANEU_OFFER_STATUS = 'GET_MFN_PANEU_OFFER_STATUS';
    case GET_REFERRAL_FEE_PREVIEW_REPORT = 'GET_REFERRAL_FEE_PREVIEW_REPORT';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_FLAT_FILE_OPEN_LISTINGS_DATA,
            self::GET_MERCHANT_LISTINGS_ALL_DATA,
            self::GET_MERCHANT_LISTINGS_DATA,
            self::GET_MERCHANT_LISTINGS_INACTIVE_DATA,
            self::GET_MERCHANT_LISTINGS_DATA_BACK_COMPAT,
            self::GET_MERCHANT_LISTINGS_DATA_LITE,
            self::GET_MERCHANT_LISTINGS_DATA_LITER,
            self::GET_MERCHANT_CANCELLED_LISTINGS_DATA,
            self::GET_MERCHANTS_LISTINGS_FYP_REPORT,
            self::GET_PAN_EU_OFFER_STATUS,
            self::GET_MFN_PANEU_OFFER_STATUS,
            self::GET_REFERRAL_FEE_PREVIEW_REPORT,
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

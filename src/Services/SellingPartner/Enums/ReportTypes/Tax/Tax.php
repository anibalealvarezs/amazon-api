<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Tax;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-tax
 */
enum Tax: string implements ReportOptions
{
    case GST_MTR_STOCK_TRANSFER_REPORT = 'GST_MTR_STOCK_TRANSFER_REPORT';
    case GST_MTR_B2B = 'GST_MTR_B2B';
    case GST_MTR_B2C = 'GST_MTR_B2C';
    case GET_FLAT_FILE_SALES_TAX_DATA = 'GET_FLAT_FILE_SALES_TAX_DATA';
    case SC_VAT_TAX_REPORT = 'SC_VAT_TAX_REPORT';
    case GET_VAT_TRANSACTION_DATA = 'GET_VAT_TRANSACTION_DATA';
    case GET_GST_MTR_B2B_CUSTOM = 'GET_GST_MTR_B2B_CUSTOM';
    case GET_GST_MTR_B2C_CUSTOM = 'GET_GST_MTR_B2C_CUSTOM';
    case GET_GST_STR_ADHOC = 'GET_GST_STR_ADHOC';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GST_MTR_STOCK_TRANSFER_REPORT,
            self::GST_MTR_B2B,
            self::GST_MTR_B2C,
            self::GET_FLAT_FILE_SALES_TAX_DATA,
            self::SC_VAT_TAX_REPORT,
            self::GET_VAT_TRANSACTION_DATA,
            self::GET_GST_MTR_B2B_CUSTOM,
            self::GET_GST_MTR_B2C_CUSTOM,
            self::GET_GST_STR_ADHOC,
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

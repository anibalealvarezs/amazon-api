<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\InvoiceData;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-invoice-data
 */
enum InvoiceData: string implements ReportOptions
{
    case GET_FLAT_FILE_VAT_INVOICE_DATA_REPORT = 'GET_FLAT_FILE_VAT_INVOICE_DATA_REPORT';
    case GET_XML_VAT_INVOICE_DATA_REPORT = 'GET_XML_VAT_INVOICE_DATA_REPORT';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_FLAT_FILE_VAT_INVOICE_DATA_REPORT,
            self::GET_XML_VAT_INVOICE_DATA_REPORT,
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

<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Returns;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-returns
 */
enum Returns: string implements ReportOptions
{
    case GET_XML_RETURNS_DATA_BY_RETURN_DATE = 'GET_XML_RETURNS_DATA_BY_RETURN_DATE';
    case GET_FLAT_FILE_RETURNS_DATA_BY_RETURN_DATE = 'GET_FLAT_FILE_RETURNS_DATA_BY_RETURN_DATE';
    case GET_XML_MFN_PRIME_RETURNS_REPORT = 'GET_XML_MFN_PRIME_RETURNS_REPORT';
    case GET_CSV_MFN_PRIME_RETURNS_REPORT = 'GET_CSV_MFN_PRIME_RETURNS_REPORT';
    case GET_XML_MFN_SKU_RETURN_ATTRIBUTES_REPORT = 'GET_XML_MFN_SKU_RETURN_ATTRIBUTES_REPORT';
    case GET_FLAT_FILE_MFN_SKU_RETURN_ATTRIBUTES_REPORT = 'GET_FLAT_FILE_MFN_SKU_RETURN_ATTRIBUTES_REPORT';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_XML_RETURNS_DATA_BY_RETURN_DATE,
            self::GET_FLAT_FILE_RETURNS_DATA_BY_RETURN_DATE,
            self::GET_XML_MFN_PRIME_RETURNS_REPORT,
            self::GET_CSV_MFN_PRIME_RETURNS_REPORT,
            self::GET_XML_MFN_SKU_RETURN_ATTRIBUTES_REPORT,
            self::GET_FLAT_FILE_MFN_SKU_RETURN_ATTRIBUTES_REPORT,
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

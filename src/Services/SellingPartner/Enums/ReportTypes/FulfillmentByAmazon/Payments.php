<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-fba
 */
enum Payments: string implements ReportOptions
{
    case GET_FBA_ESTIMATED_FBA_FEES_TXT_DATA = 'GET_FBA_ESTIMATED_FBA_FEES_TXT_DATA';
    case GET_FBA_REIMBURSEMENTS_DATA = 'GET_FBA_REIMBURSEMENTS_DATA';
    case GET_FBA_FULFILLMENT_LONGTERM_STORAGE_FEE_CHARGES_DATA = 'GET_FBA_FULFILLMENT_LONGTERM_STORAGE_FEE_CHARGES_DATA';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_FBA_ESTIMATED_FBA_FEES_TXT_DATA,
            self::GET_FBA_REIMBURSEMENTS_DATA,
            self::GET_FBA_FULFILLMENT_LONGTERM_STORAGE_FEE_CHARGES_DATA,
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

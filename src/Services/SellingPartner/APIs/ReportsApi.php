<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\APIs;

use Carbon\Carbon;
use Anibalealvarezs\AmazonApi\Services\Ads\Enums\TimeUnit;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\AmazonBusiness\AmazonBusiness;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Analytics\Brand;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Analytics\Seller;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Analytics\Vendor\Vendor;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\B2BProductOpportunities\B2BProductOpportunities;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\BrowseTree\BrowseTree;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\EasyShip\EasyShip;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon\Concessions;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon\Inventory as FBAInventory;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon\Payments;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon\Removals;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon\Sales;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon\SmallAndLight;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\FulfillmentByAmazon\SubscribeAndSave;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Inventory\Inventory;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\InvoiceData\InvoiceData;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Order\Order;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Order\Pending;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Order\Tracking;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Performance\Performance;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\RegulatoryCompliance\RegulatoryCompliance;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Returns\Returns;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Settlement\Settlement;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Tax\Tax;
use Anibalealvarezs\AmazonApi\Services\SellingPartner\SellingPartnerApi;
use GuzzleHttp\Exception\GuzzleException;

class ReportsApi extends SellingPartnerApi
{
    /**
     * @param string $name
     * @param AmazonBusiness|Brand|Seller|\Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\Analytics\Vendor\Vendor|B2BProductOpportunities|BrowseTree|EasyShip|Concessions|FBAInventory|Payments|Removals|Sales|SmallAndLight|SubscribeAndSave|Inventory|InvoiceData|Order|Pending|Tracking|Performance|RegulatoryCompliance|Returns|Settlement|Tax $reportType
     * @param string|null $startDatetime
     * @param string|null $endDatetime
     * @param string[] $marketplaceIds
     * @param TimeUnit $timeUnit
     * @return array
     * @throws GuzzleException
     */
    public function createReport(
        string $name,
        AmazonBusiness|Brand|Seller|Vendor|B2BProductOpportunities|BrowseTree|EasyShip|Concessions|FBAInventory|
            Payments|Removals|Sales|SmallAndLight|SubscribeAndSave|Inventory|InvoiceData|Order|Pending|Tracking|
            Performance|RegulatoryCompliance|Returns|Settlement|Tax $reportType = Vendor::GET_VENDOR_SALES_REPORT,
        ?string $startDatetime = null,
        ?string $endDatetime = null,
        array $marketplaceIds = [],
        TimeUnit $timeUnit = TimeUnit::SUMMARY,
    ): array {
        if ($timeUnit === TimeUnit::SUMMARY) {
            $columns = array_values(array_filter($columns, fn ($column) => $column->value !== 'date'));
        } else {
            $columns = array_values(array_filter($columns, fn ($column) => $column->value !== 'startDate' && $column->value !== 'endDate'));
        }

        $body = [
            "name" => $name,
            "configuration" => [
                "adProduct" => $adProduct->value,
                "columns" => array_map(callback: fn ($column) => $column->value, array: $columns),
                "reportTypeId" => $reportType->getId(adType: $adProduct),
                "format" => $format->value,
                "groupBy" => array_map(callback: fn ($group) => $group->value, array: $groupBy),
                "timeUnit" => $timeUnit->value
            ]
        ];

        if ($startDatetime) {
            $body["startDate"] = Carbon::parse($startDatetime)->toIso8601String();
        }
        if ($endDatetime) {
            $body["endDate"] = Carbon::parse($endDatetime)->toIso8601String();
        }

        // Request the spreadsheet data
        $response = $this->performRequest(
            method: "POST",
            endpoint: "reports/2021-06-30/reports",
            body: json_encode($body),
            additionalHeaders: [
                "Amazon-Advertising-API-Scope" => $this->profileId,
                "Content-Type" => "application/vnd.createasyncreportrequest.v3+json",
            ],
        );
        // Return response
        return json_decode($response->getBody()->getContents(), true);
    }
}
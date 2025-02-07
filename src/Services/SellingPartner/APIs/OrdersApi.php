<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\APIs;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\SellingPartnerApi;
use GuzzleHttp\Exception\GuzzleException;

class OrdersApi extends SellingPartnerApi
{
    /**
     * @param array $marketplaceIds
     * @param string|null $createdAfter
     * @param string|null $createdBefore
     * @param string|null $lastUpdatedAfter
     * @param string|null $lastUpdatedBefore
     * @param array|null $orderStatuses
     * @param array|null $fulfillmentChannels
     * @param array|null $paymentMethods
     * @param string|null $buyerEmail
     * @param string|null $sellerOrderId
     * @param int $maxResultsPerPage
     * @param array|null $easyShipShipmentStatuses
     * @param array|null $electronicInvoiceStatuses
     * @param string|null $nextToken
     * @param array|null $amazonOrderIds
     * @param string|null $actualFulfillmentSupplySourceId
     * @param bool|null $isISPU
     * @param string|null $storeChainStoreId
     * @return array
     * @throws GuzzleException
     */
    public function getOrders(
        array $marketplaceIds = ['ATVPDKIKX0DER'],
        string $createdAfter = null,
        string $createdBefore = null,
        string $lastUpdatedAfter = null,
        string $lastUpdatedBefore = null,
        array $orderStatuses = null,
        array $fulfillmentChannels = null,
        array $paymentMethods = null,
        string $buyerEmail = null,
        string $sellerOrderId = null,
        int $maxResultsPerPage = 100, // Min: 1 / Max: 100
        array $easyShipShipmentStatuses = null,
        array $electronicInvoiceStatuses = null,
        string $nextToken = null,
        array $amazonOrderIds = null,
        string $actualFulfillmentSupplySourceId = null,
        bool $isISPU = null,
        string $storeChainStoreId = null,
    ): array
    {
        $query = [
            'MarketplaceIds' => implode(',', $marketplaceIds),
            'MaxResultsPerPage' => $maxResultsPerPage,
        ];
        if ($createdAfter) {
            $query["CreatedAfter"] = $createdAfter;
        }
        if ($createdBefore) {
            $query["CreatedBefore"] = $createdBefore;
        }
        if ($lastUpdatedAfter) {
            $query["LastUpdatedAfter"] = $lastUpdatedAfter;
        }
        if ($lastUpdatedBefore) {
            $query["LastUpdatedBefore"] = $lastUpdatedBefore;
        }
        if ($orderStatuses) {
            $query["OrderStatuses"] = implode(',', $orderStatuses);
        }
        if ($fulfillmentChannels) {
            $query["FulfillmentChannels"] = implode(',', $fulfillmentChannels);
        }
        if ($paymentMethods) {
            $query["PaymentMethods"] = implode(',', $paymentMethods);
        }
        if ($buyerEmail) {
            $query["BuyerEmail"] = $buyerEmail;
        }
        if ($sellerOrderId) {
            $query["SellerOrderId"] = $sellerOrderId;
        }
        if ($easyShipShipmentStatuses) {
            $query["EasyShipShipmentStatuses"] = implode(',', $easyShipShipmentStatuses);
        }
        if ($electronicInvoiceStatuses) {
            $query["ElectronicInvoiceStatuses"] = implode(',', $electronicInvoiceStatuses);
        }
        if ($nextToken) {
            $query["NextToken"] = $nextToken;
        }
        if ($amazonOrderIds) {
            $query["AmazonOrderIds"] = implode(',', $amazonOrderIds);
        }
        if ($actualFulfillmentSupplySourceId) {
            $query["ActualFulfillmentSupplySourceId"] = $actualFulfillmentSupplySourceId;
        }
        if ($isISPU) {
            $query["IsISPU"] = $isISPU;
        }
        if ($storeChainStoreId) {
            $query["StoreChainStoreId"] = $storeChainStoreId;
        }

        // Request the spreadsheet data
        $response = $this->performRequest(
            method: "GET",
            endpoint: "/orders/v0/orders",
            query: $query,
            additionalHeaders: [
                "Content-Type" => "application/json; charset=utf-8",
            ],
        );
        // Return response
        return json_decode($response->getBody()->getContents(), true);
    }
}
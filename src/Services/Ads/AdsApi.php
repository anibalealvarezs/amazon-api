<?php

namespace Anibalealvarezs\AmazonApi\Services\Ads;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Anibalealvarezs\AmazonApi\Amazon\AmazonApi;
use Anibalealvarezs\AmazonApi\Services\Ads\Enums\AdType;
use Anibalealvarezs\AmazonApi\Services\Ads\Enums\Column;
use Anibalealvarezs\AmazonApi\Services\Ads\Enums\Format;
use Anibalealvarezs\AmazonApi\Services\Ads\Enums\GroupBy;
use Anibalealvarezs\AmazonApi\Services\Ads\Enums\ReportType;
use Anibalealvarezs\AmazonApi\Services\Ads\Enums\TimeUnit;

class AdsApi extends AmazonApi
{
    protected string $profileId;

    /**
     * @param string $redirectUrl
     * @param string $clientId
     * @param string $clientSecret
     * @param string $refreshToken
     * @param array $scopes
     * @param string $token
     * @param string $profileId
     * @throws GuzzleException
     */
    public function __construct(
        string $redirectUrl,
        string $clientId,
        string $clientSecret,
        string $refreshToken,
        array $scopes = [],
        string $token = "",
        string $profileId = "",
    ) {
        $this->profileId = $profileId;

        parent::__construct(
            baseUrl: "https://advertising-api.amazon.com",
            redirectUrl: $redirectUrl,
            clientId: $clientId,
            clientSecret: $clientSecret,
            refreshToken: $refreshToken,
            scopes: ($scopes ?: ["advertising::campaign_management"]),
            token: $token,
            defaultHeaders: [
                'Amazon-Advertising-API-ClientId' => $clientId,
            ],
        );
    }

    /**
     * @throws GuzzleException
     */
    public function getProfiles(): array
    {
        // Request the spreadsheet data
        $response = $this->performRequest(
            method: "GET",
            endpoint: "/v2/profiles",
            additionalHeaders: [
                "Content-Type" => "application/json",
            ],
        );
        // Return response
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $name
     * @param ReportType $reportType
     * @param string|null $startDate
     * @param string|null $endDate
     * @param string[]|GroupBy[] $groupBy
     * @param TimeUnit $timeUnit
     * @param string[]|Column[] $columns
     * @param Format $format
     * @param AdType $adProduct
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function createReport(
        string $name,
        ReportType $reportType,
        ?string $startDate,
        ?string $endDate,
        array $groupBy = [],
        TimeUnit $timeUnit = TimeUnit::SUMMARY,
        array $columns = [],
        Format $format = Format::GZIP_JSON,
        AdType $adProduct = AdType::SPONSORED_PRODUCTS,
    ): array {
        foreach ($groupBy as $group) {
            if (!$group instanceof GroupBy && !is_string($group)) {
                throw new Exception("Invalid group: " . var_dump($group));
            }
            if (is_string($group)) {
                $group = GroupBy::from($group);
            }
            if (!in_array($group, GroupBy::getListFor($reportType))) {
                throw new Exception("Invalid group: " . $group->value . " for report type: " . $reportType->value);
            }
        }
        foreach ($columns as $column) {
            if (!$column instanceof Column && !is_string($column)) {
                throw new Exception("Invalid column: " . var_dump($column));
            }
            if (is_string($column)) {
                $column = Column::from($column);
            }
            if (!in_array($column, Column::getListFor($reportType))) {
                throw new Exception("Invalid column: " . $column->value . " for report type: " . $reportType->value);
            }
        }
        if (empty($columns)) {
            $columns = Column::getListFor($reportType);
        }

        if ($timeUnit === TimeUnit::SUMMARY) {
            $columns = array_values(array_filter($columns, fn ($column) => $column->value !== 'date'));
        } else {
            $columns = array_values(array_filter($columns, fn ($column) => $column->value !== 'startDate' && $column->value !== 'endDate'));
        }

        $body = [
            "name" => $name,
            "startDate" => Carbon::parse($startDate)->format("Y-m-d"),
            "endDate" => Carbon::parse($endDate)->format("Y-m-d"),
            "configuration" => [
                "adProduct" => $adProduct->value,
                "columns" => array_map(callback: fn ($column) => $column->value, array: $columns),
                "reportTypeId" => $reportType->getId(adType: $adProduct),
                "format" => $format->value,
                "groupBy" => array_map(callback: fn ($group) => $group->value, array: $groupBy),
                "timeUnit" => $timeUnit->value
            ]
        ];

        // Request the spreadsheet data
        $response = $this->performRequest(
            method: "POST",
            endpoint: "/reporting/reports",
            body: json_encode($body),
            additionalHeaders: [
                "Amazon-Advertising-API-Scope" => $this->profileId,
                "Content-Type" => "application/vnd.createasyncreportrequest.v3+json",
            ],
        );
        // Return response
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $reportId
     * @return array
     * @throws GuzzleException
     */
    public function checkReport(
        string $reportId,
    ): array {
        // Request the spreadsheet data
        $response = $this->performRequest(
            method: "GET",
            endpoint: "/reporting/reports/" . $reportId,
            additionalHeaders: [
                "Amazon-Advertising-API-Scope" => $this->profileId,
                "Content-Type" => "application/vnd.createasyncreportrequest.v3+json",
            ],
        );
        // Return response
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $url
     * @param string $path
     * @param bool $stream
     * @param array $query
     * @return bool
     * @throws GuzzleException
     */
    public function downloadReport(
        string $url,
        string $path,
        bool $stream = false,
        array $query = [],
    ): bool {
        $headers = $this->headers;
        $this->headers = [];
        // Request the spreadsheet data
        $response = $this->performRequest(
            method: "GET",
            endpoint: "",
            query: $query,
            baseUrl: $url,
            pathToSave: $path,
            stream: $stream,
            ignoreAuth: true,
        );
        $this->headers = $headers;
        // Return response
        return $response->getStatusCode() === 200;
    }

    /**
     * @param string $name
     * @param ReportType $reportType
     * @param string|null $startDate
     * @param string|null $endDate
     * @param string $path
     * @param string[]|GroupBy[] $groupBy
     * @param TimeUnit $timeUnit
     * @param string[]|Column[] $columns
     * @param Format $format
     * @param AdType $adProduct
     * @param bool $stream
     * @return bool
     * @throws GuzzleException
     */
    public function createAndSaveReport(
        string $name,
        ReportType $reportType,
        ?string $startDate,
        ?string $endDate,
        string $path,
        array $groupBy = [],
        TimeUnit $timeUnit = TimeUnit::SUMMARY,
        array $columns = [],
        Format $format = Format::GZIP_JSON,
        AdType $adProduct = AdType::SPONSORED_PRODUCTS,
        bool $stream = false,
    ): bool {
        $report = $this->createReport(
            name: $name,
            reportType: $reportType,
            startDate: $startDate,
            endDate: $endDate,
            groupBy: $groupBy,
            timeUnit: $timeUnit,
            columns: $columns,
            format: $format,
            adProduct: $adProduct,
        );
        
        if (isset($report['reportId'])) {
            return $this->checkAndDownloadReport($report['reportId'], $path, $name, $stream);
        }

        return false;
    }

    /**
     * @param string $name
     * @param ReportType $reportType
     * @param string|null $startDate
     * @param string|null $endDate
     * @param string $path
     * @param array $groupBy
     * @param TimeUnit $timeUnit
     * @param array $columns
     * @param Format $format
     * @param AdType $adProduct
     * @param bool $stream
     * @return bool
     * @throws GuzzleException
     */
    /* public function fiberedCreateAndSaveReport(
        string $name,
        ReportType $reportType,
        ?string $startDate,
        ?string $endDate,
        string $path,
        array $groupBy = [],
        TimeUnit $timeUnit = TimeUnit::SUMMARY,
        array $columns = [],
        Format $format = Format::GZIP_JSON,
        AdType $adProduct = AdType::SPONSORED_PRODUCTS,
        bool $stream = false,
    ): bool {
        $report = $this->createReport(
            name: $name,
            reportType: $reportType,
            startDate: $startDate,
            endDate: $endDate,
            groupBy: $groupBy,
            timeUnit: $timeUnit,
            columns: $columns,
            format: $format,
            adProduct: $adProduct,
        );

        $checking = new Fiber(function () use ($report, $path, $name, $stream) {
            while (!isset($checking)) {
                if ($this->checkAndDownloadReport($report['reportId'], $path, $name, $stream)) {
                    $checking->cancel();
                }
            }
        });

        return false;
    } */

    /**
     * @param string $reportId
     * @param string $path
     * @param string $name
     * @param bool $stream
     * @return bool
     * @throws GuzzleException
     */
    protected function checkAndDownloadReport(string $reportId, string $path, string $name, bool $stream): bool
    {
        while (true) {
            $check = $this->checkReport(
                reportId: $reportId,
            );
            if (isset($check['status']) && $check['status'] === "COMPLETED") {
                $url = parse_url($check['url']);
                parse_str($url['query'], $query);
                return $this->downloadReport(
                    url: $url['scheme'] . "://" . $url['host'] . $url['path'],
                    path: $path . "/" . $name . '_' . $reportId . ".json.gz",
                    stream: $stream,
                    query: $query,
                );
            } else {
                sleep(5);
            }
        }
    }

    /**
     * @param int $maxResults
     * @param bool $includeExtendedDataFields
     * @param string|null $nextToken
     * @return array
     * @throws GuzzleException
     */
    public function getSponsoredProductsCampaigns(
        int $maxResults = 1000,
        bool $includeExtendedDataFields = true,
        ?string $nextToken = null,
    ): array {

        $body = [
            "maxResults" => $maxResults,
            "includeExtendedDataFields" => $includeExtendedDataFields,
        ];

        if ($nextToken) {
            $body['nextToken'] = $nextToken;
        }

        // Request the spreadsheet data
        $response = $this->performRequest(
            method: "POST",
            endpoint: "/sp/campaigns/list",
            body: json_encode($body),
            additionalHeaders: [
                "Amazon-Advertising-API-Scope" => $this->profileId,
                "Accept" => "application/vnd.spcampaign.v3+json",
                "Content-Type" => "application/vnd.spcampaign.v3+json",
            ],
        );
        // Return response
        return json_decode($response->getBody()->getContents(), true);
    }

    /*
     * @param bool $includeExtendedDataFields
     */
    public function getAllSponsoredProductsCampaigns(
        bool $includeExtendedDataFields = true,
    ): array {

        $nextToken = null;
        $campaigns = [
            'campaigns' => [],
        ];

        do {
            $response = $this->getSponsoredProductsCampaigns(
                includeExtendedDataFields: $includeExtendedDataFields,
                nextToken: $nextToken,
            );
            $campaigns['campaigns'] = array_merge($campaigns['campaigns'], $response['campaigns']);
        } while (isset($response['nextToken']) && $nextToken = $response['nextToken']);

        return $campaigns;
    }

    /**
     * @param int $maxResults
     * @param bool $includeExtendedDataFields
     * @param string|null $nextToken
     * @return array
     * @throws GuzzleException
     */
    public function getSponsoredProductsAdGroups(
        int $maxResults = 1000,
        bool $includeExtendedDataFields = true,
        ?string $nextToken = null,
    ): array {

        $body = [
            "maxResults" => $maxResults,
            "includeExtendedDataFields" => $includeExtendedDataFields,
        ];

        if ($nextToken) {
            $body['nextToken'] = $nextToken;
        }

        // Request the spreadsheet data
        $response = $this->performRequest(
            method: "POST",
            endpoint: "/sp/adGroups/list",
            body: json_encode($body),
            additionalHeaders: [
                "Amazon-Advertising-API-Scope" => $this->profileId,
                "Accept" => "application/vnd.spAdGroup.v3+json",
                "Content-Type" => "application/vnd.spAdGroup.v3+json",
            ],
        );
        // Return response
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param bool $includeExtendedDataFields
     * @return array
     * @throws GuzzleException
     */
    public function getAllSponsoredProductsAdGroups(
        bool $includeExtendedDataFields = true,
    ): array {

        $nextToken = null;
        $adGroups = [
            'adGroups' => [],
        ];

        do {
            $response = $this->getSponsoredProductsAdGroups(
                includeExtendedDataFields: $includeExtendedDataFields,
                nextToken: $nextToken,
            );
            $adGroups['adGroups'] = array_merge($adGroups['adGroups'], $response['adGroups']);
        } while (isset($response['nextToken']) && $nextToken = $response['nextToken']);

        return $adGroups;
    }

    /**
     * @param int $maxResults
     * @param bool $includeExtendedDataFields
     * @param string|null $nextToken
     * @return array
     * @throws GuzzleException
     */
    public function getSponsoredProductsAds(
        int $maxResults = 1000,
        bool $includeExtendedDataFields = true,
        ?string $nextToken = null,
    ): array {

        $body = [
            "maxResults" => $maxResults,
            "includeExtendedDataFields" => $includeExtendedDataFields,
        ];

        if ($nextToken) {
            $body['nextToken'] = $nextToken;
        }

        // Request the spreadsheet data
        $response = $this->performRequest(
            method: "POST",
            endpoint: "/sp/productAds/list",
            body: json_encode($body),
            additionalHeaders: [
                "Amazon-Advertising-API-Scope" => $this->profileId,
                "Accept" => "application/vnd.spproductAd.v3+json",
                "Content-Type" => "application/vnd.spproductAd.v3+json",
            ],
        );
        // Return response
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param bool $includeExtendedDataFields
     * @return array
     * @throws GuzzleException
     */
    public function getAllSponsoredProductsAds(
        bool $includeExtendedDataFields = true,
    ): array {

        $nextToken = null;
        $ads = [
            'productAds' => [],
        ];

        do {
            $response = $this->getSponsoredProductsAds(
                includeExtendedDataFields: $includeExtendedDataFields,
                nextToken: $nextToken,
            );
            $ads['productAds'] = array_merge($ads['productAds'], $response['productAds']);
        } while (isset($response['nextToken']) && $nextToken = $response['nextToken']);

        return $ads;
    }
}

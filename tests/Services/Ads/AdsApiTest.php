<?php

namespace Tests\Services\Ads;

use Anibalealvarezs\AmazonApi\Services\Ads\AdsApi;
use Faker\Factory;
use Faker\Generator;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

class AdsApiTest extends TestCase
{
    private AdsApi $adsApi;
    private Generator $faker;

    /**
     * @throws GuzzleException
     */
    protected function setUp(): void
    {
        $config = Yaml::parseFile(__DIR__ . "/../../../config/config.yaml");
        $this->adsApi = new AdsApi(
            redirectUrl: 'https://oauth.pstmn.io/v1/callback',
            clientId: $config['ads_client_id'],
            clientSecret: $config['ads_client_secret'],
            refreshToken: $config['ads_refresh_token'],
            profileId: $config['ads_profile_id']
        );
        $this->faker = Factory::create();
    }

    public function testConstruct(): void
    {
        $this->assertInstanceOf(adsApi::class, $this->adsApi);
    }

    /**
     * @throws GuzzleException
     */
    public function testGetProfiles(): void
    {
        $profiles = $this->adsApi->getProfiles();

        $this->assertIsArray($profiles);

        if (count($profiles) === 0) {
            return;
        }

        $this->assertArrayHasKey('profileId', $profiles[0]);
        $this->assertArrayHasKey('countryCode', $profiles[0]);
        $this->assertArrayHasKey('currencyCode', $profiles[0]);
        $this->assertArrayHasKey('dailyBudget', $profiles[0]);
        $this->assertArrayHasKey('timezone', $profiles[0]);
        $this->assertArrayHasKey('accountInfo', $profiles[0]);
        $this->assertIsArray($profiles[0]['accountInfo']);
        $this->assertArrayHasKey('marketplaceStringId', $profiles[0]['accountInfo']);
        $this->assertArrayHasKey('id', $profiles[0]['accountInfo']);
        $this->assertArrayHasKey('type', $profiles[0]['accountInfo']);
        $this->assertArrayHasKey('name', $profiles[0]['accountInfo']);
        $this->assertArrayHasKey('validPaymentMethod', $profiles[0]['accountInfo']);
    }

    /**
     * @throws GuzzleException
     */
    public function testGetSponsoredProductsCampaigns()
    {
        $campaigns = $this->adsApi->getSponsoredProductsCampaigns(
            maxResults: $this->faker->numberBetween(1, 1000),
            includeExtendedDataFields: $this->faker->boolean()
        );

        $this->assertIsArray($campaigns);
        $this->assertIsArray($campaigns['campaigns']);
        
        $campaignsList = $campaigns['campaigns'];

        if (count($campaignsList) === 0) {
            return;
        }

        $this->assertCampaigns($campaignsList);
    }

    /**
     */
    public function testGetAllSponsoredProductsCampaigns()
    {
        $campaigns = $this->adsApi->getAllSponsoredProductsCampaigns(
            includeExtendedDataFields: $this->faker->boolean()
        );

        $this->assertIsArray($campaigns);
        $this->assertIsArray($campaigns['campaigns']);

        $campaignsList = $campaigns['campaigns'];

        if (count($campaignsList) === 0) {
            return;
        }

        $this->assertCampaigns($campaignsList);
    }

    /**
     */
    private function assertCampaigns(array $campaignsList): void
    {
        $this->assertArrayHasKey('budget', $campaignsList[0]);
        $this->assertIsArray($campaignsList[0]['budget']);
        $this->assertArrayHasKey('budget', $campaignsList[0]['budget']);
        $this->assertIsFloat($campaignsList[0]['budget']['budget']);
        if (isset($campaignsList[0]['budget']['effectiveBudget'])) {
            $this->assertIsFloat($campaignsList[0]['budget']['effectiveBudget']);
        }
        $this->assertArrayHasKey('budgetType', $campaignsList[0]['budget']);
        $this->assertArrayHasKey('campaignId', $campaignsList[0]);
        $this->assertArrayHasKey('dynamicBidding', $campaignsList[0]);
        $this->assertIsArray($campaignsList[0]['dynamicBidding']);
        $this->assertArrayHasKey('placementBidding', $campaignsList[0]['dynamicBidding']);
        $this->assertIsArray($campaignsList[0]['dynamicBidding']['placementBidding']);
        if (count($campaignsList[0]['dynamicBidding']['placementBidding']) > 0) {
            $this->assertArrayHasKey('placement', $campaignsList[0]['dynamicBidding']['placementBidding'][0]);
            $this->assertArrayHasKey('percentage', $campaignsList[0]['dynamicBidding']['placementBidding'][0]);
            $this->assertIsInt($campaignsList[0]['dynamicBidding']['placementBidding'][0]['percentage']);
        }
        if (isset($campaignsList[0]['dynamicBidding']['shopperCohortBidding'])) {
            $this->assertIsArray($campaignsList[0]['dynamicBidding']['shopperCohortBidding']);
            if (count($campaignsList[0]['dynamicBidding']['shopperCohortBidding']) > 0) {
                $this->assertArrayHasKey('shopperCohortType', $campaignsList[0]['dynamicBidding']['shopperCohortBidding'][0]);
                $this->assertArrayHasKey('percentage', $campaignsList[0]['dynamicBidding']['shopperCohortBidding'][0]);
                $this->assertIsInt($campaignsList[0]['dynamicBidding']['shopperCohortBidding'][0]['percentage']);
                $this->assertArrayHasKey('audienceSegments', $campaignsList[0]['dynamicBidding']['shopperCohortBidding'][0]);
                $this->assertIsArray($campaignsList[0]['dynamicBidding']['shopperCohortBidding'][0]['audienceSegments']);
                if (count($campaignsList[0]['dynamicBidding']['shopperCohortBidding'][0]['audienceSegments']) > 0) {
                    $this->assertArrayHasKey('audienceId', $campaignsList[0]['dynamicBidding']['shopperCohortBidding'][0]['audienceSegments'][0]);
                    $this->assertArrayHasKey('audienceSegmentType', $campaignsList[0]['dynamicBidding']['shopperCohortBidding'][0]['audienceSegments'][0]);
                }
            }
        }
        $this->assertArrayHasKey('strategy', $campaignsList[0]['dynamicBidding']);
        if (isset($campaignsList[0]['extendedData'])) {
            $this->assertArrayHasKey('creationDateTime', $campaignsList[0]['extendedData']);
            $this->assertArrayHasKey('lastUpdateDateTime', $campaignsList[0]['extendedData']);
            $this->assertArrayHasKey('servingStatus', $campaignsList[0]['extendedData']);
            $this->assertArrayHasKey('servingStatusDetails', $campaignsList[0]['extendedData']);
            $this->assertIsArray($campaignsList[0]['extendedData']['servingStatusDetails']);
            if (count($campaignsList[0]['extendedData']['servingStatusDetails']) > 0) {
                $this->assertArrayHasKey('name', $campaignsList[0]['extendedData']['servingStatusDetails'][0]);
            }
        }
        $this->assertArrayHasKey('name', $campaignsList[0]);
        $this->assertArrayHasKey('startDate', $campaignsList[0]);
        $this->assertArrayHasKey('state', $campaignsList[0]);
        $this->assertArrayHasKey('targetingType', $campaignsList[0]);
        $this->assertArrayHasKey('tags', $campaignsList[0]);
    }

    /**
     * @throws GuzzleException
     */
    public function testGetSponsoredProductsAdGroups()
    {
        $adGroups = $this->adsApi->getSponsoredProductsAdGroups(
            maxResults: $this->faker->numberBetween(1, 1000),
            includeExtendedDataFields: $this->faker->boolean()
        );

        $this->assertIsArray($adGroups);
        $this->assertIsArray($adGroups['adGroups']);

        $adGroupsList = $adGroups['adGroups'];

        if (count($adGroupsList) === 0) {
            return;
        }

        $this->assertAdGroups($adGroupsList);
    }

    /**
     */
    public function testGetAllSponsoredProductsAdGroups()
    {
        $adGroups = $this->adsApi->getAllSponsoredProductsAdGroups(
            includeExtendedDataFields: $this->faker->boolean()
        );

        $this->assertIsArray($adGroups);
        $this->assertIsArray($adGroups['adGroups']);

        $adGroupsList = $adGroups['adGroups'];

        if (count($adGroupsList) === 0) {
            return;
        }

        $this->assertAdGroups($adGroupsList);
    }

    private function assertAdGroups(array $adGroupsList): void
    {
        $this->assertArrayHasKey('adGroupId', $adGroupsList[0]);
        $this->assertArrayHasKey('campaignId', $adGroupsList[0]);
        $this->assertArrayHasKey('name', $adGroupsList[0]);
        $this->assertArrayHasKey('state', $adGroupsList[0]);
        $this->assertArrayHasKey('defaultBid', $adGroupsList[0]);
        $this->assertIsFloat($adGroupsList[0]['defaultBid']);
        if (isset($adGroupsList[0]['extendedData'])) {
            $this->assertArrayHasKey('creationDateTime', $adGroupsList[0]['extendedData']);
            $this->assertArrayHasKey('lastUpdateDateTime', $adGroupsList[0]['extendedData']);
            $this->assertArrayHasKey('servingStatus', $adGroupsList[0]['extendedData']);
            $this->assertArrayHasKey('servingStatusDetails', $adGroupsList[0]['extendedData']);
            $this->assertIsArray($adGroupsList[0]['extendedData']['servingStatusDetails']);
            if (count($adGroupsList[0]['extendedData']['servingStatusDetails']) > 0) {
                $this->assertArrayHasKey('name', $adGroupsList[0]['extendedData']['servingStatusDetails'][0]);
            }
        }
    }

    /**
     * @throws GuzzleException
     */
    public function testGetSponsoredProductsAds()
    {
        $ads = $this->adsApi->getSponsoredProductsAds(
            maxResults: $this->faker->numberBetween(1, 1000),
            includeExtendedDataFields: $this->faker->boolean()
        );

        $this->assertIsArray($ads);
        $this->assertIsArray($ads['productAds']);

        $adsList = $ads['productAds'];

        if (count($adsList) === 0) {
            return;
        }

        $this->assertAds($adsList);
    }

    /**
     */
    public function testGetAllSponsoredProductsAds()
    {
        $ads = $this->adsApi->getAllSponsoredProductsAds(
            includeExtendedDataFields: $this->faker->boolean()
        );

        $this->assertIsArray($ads);
        $this->assertIsArray($ads['productAds']);

        $adsList = $ads['productAds'];

        if (count($adsList) === 0) {
            return;
        }

        $this->assertAds($adsList);
    }

    /**
     */
    private function assertAds(array $adsList): void
    {
        $this->assertArrayHasKey('adId', $adsList[0]);
        $this->assertArrayHasKey('adGroupId', $adsList[0]);
        $this->assertArrayHasKey('campaignId', $adsList[0]);
        $this->assertArrayHasKey('state', $adsList[0]);
        $this->assertArrayHasKey('asin', $adsList[0]);
        $this->assertArrayHasKey('sku', $adsList[0]);
        if (isset($adGroupsList[0]['extendedData'])) {
            $this->assertArrayHasKey('creationDateTime', $adGroupsList[0]['extendedData']);
            $this->assertArrayHasKey('lastUpdateDateTime', $adGroupsList[0]['extendedData']);
            $this->assertArrayHasKey('servingStatus', $adGroupsList[0]['extendedData']);
            $this->assertArrayHasKey('servingStatusDetails', $adGroupsList[0]['extendedData']);
            $this->assertIsArray($adGroupsList[0]['extendedData']['servingStatusDetails']);
            if (count($adGroupsList[0]['extendedData']['servingStatusDetails']) > 0) {
                $this->assertArrayHasKey('name', $adGroupsList[0]['extendedData']['servingStatusDetails'][0]);
            }
        }
        if (isset($adsList[0]['globalStoreSetting'])) {
            $this->assertIsArray($adsList[0]['globalStoreSetting']);
            $this->assertArrayHasKey('catalogSourceCountryCode', $adsList[0]['globalStoreSetting']);
        }
    }
}
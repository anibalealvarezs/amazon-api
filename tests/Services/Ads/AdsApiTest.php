<?php

namespace Tests\Services\Ads;

use Anibalealvarezs\AmazonApi\Services\Ads\AdsApi;
use Faker\Factory;
use Faker\Generator;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class AdsApiTest extends TestCase
{
    private AdsApi $adsApi;
    private Generator $faker;

    /**
     * @param MockHandler $mock
     * @return GuzzleClient
     */
    protected function createMockedGuzzleClient(MockHandler $mock): GuzzleClient
    {
        $handlerStack = HandlerStack::create($mock);
        return new GuzzleClient(['handler' => $handlerStack]);
    }

    /**
     * @throws GuzzleException
     */
    protected function setUp(): void
    {
        $this->faker = Factory::create();

        // Default mock for setup
        $mock = new MockHandler([
            new Response(200, [], json_encode(['access_token' => 'mock_token'])),
            new Response(200, [], json_encode(['campaigns' => []])),
        ]);
        $guzzle = $this->createMockedGuzzleClient($mock);

        $this->adsApi = new AdsApi(
            redirectUrl: 'https://test-ads.com',
            clientId: 'id',
            clientSecret: 'secret',
            refreshToken: 'token',
            profileId: 'test-profile',
            guzzleClient: $guzzle
        );
    }

    public function testConstruct(): void
    {
        $this->assertInstanceOf(AdsApi::class, $this->adsApi);
    }

    /**
     * @throws GuzzleException
     */
    public function testGetProfiles(): void
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['access_token' => 'mock_token'])),
            new Response(200, [], json_encode([
                [
                    'profileId' => 'p1',
                    'countryCode' => 'US',
                    'currencyCode' => 'USD',
                    'dailyBudget' => 10.0,
                    'timezone' => 'UTC',
                    'accountInfo' => [
                        'marketplaceStringId' => 'm1',
                        'id' => 'i1',
                        'type' => 't1',
                        'name' => 'n1',
                        'validPaymentMethod' => true
                    ]
                ]
            ])),
        ]);
        $this->adsApi->setGuzzleClient($this->createMockedGuzzleClient($mock));

        $profiles = $this->adsApi->getProfiles();
        $this->assertIsArray($profiles);
        $this->assertCount(1, $profiles);
        $this->assertEquals('p1', $profiles[0]['profileId']);
    }

    /**
     * @throws GuzzleException
     */
    public function testGetSponsoredProductsCampaigns(): void
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['access_token' => 'mock_token'])),
            new Response(200, [], json_encode(['campaigns' => [['campaignId' => 'c1']]])),
        ]);
        $this->adsApi->setGuzzleClient($this->createMockedGuzzleClient($mock));

        $campaigns = $this->adsApi->getSponsoredProductsCampaigns();
        $this->assertIsArray($campaigns);
    }

    /**
     * @throws GuzzleException
     */
    public function testGetSponsoredProductsCampaignsAndProcess(): void
    {
        $response1 = [
            'campaigns' => [['campaignId' => 'c1']],
            'nextToken' => 'next_token'
        ];
        $response2 = [
            'campaigns' => [['campaignId' => 'c2']],
        ];
        $mock = new MockHandler([
            new Response(200, [], json_encode(['access_token' => 'mock_token'])),
            new Response(200, [], json_encode($response1)),
            new Response(200, [], json_encode($response2)),
        ]);
        $this->adsApi->setGuzzleClient($this->createMockedGuzzleClient($mock));

        $processedCount = 0;
        $this->adsApi->getSponsoredProductsCampaignsAndProcess(function ($data) use (&$processedCount) {
            $processedCount += count($data);
        });

        $this->assertEquals(2, $processedCount);
    }

    /**
     * @throws GuzzleException
     */
    public function testGetAllSponsoredProductsCampaignsPaginated(): void
    {
        $response1 = [
            'campaigns' => [['campaignId' => 'c1']],
            'nextToken' => 'next_token'
        ];
        $response2 = [
            'campaigns' => [['campaignId' => 'c2']],
        ];
        $mock = new MockHandler([
            new Response(200, [], json_encode(['access_token' => 'mock_token'])),
            new Response(200, [], json_encode($response1)),
            new Response(200, [], json_encode($response2)),
        ]);
        $this->adsApi->setGuzzleClient($this->createMockedGuzzleClient($mock));

        $result = $this->adsApi->getAllSponsoredProductsCampaigns();
        $this->assertCount(2, $result['campaigns']);
    }

    /**
     * @throws GuzzleException
     */
    public function testGetSponsoredProductsCampaignsEmpty(): void
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['access_token' => 'mock_token'])),
            new Response(200, [], json_encode(['campaigns' => []])),
        ]);
        $this->adsApi->setGuzzleClient($this->createMockedGuzzleClient($mock));

        $result = $this->adsApi->getAllSponsoredProductsCampaigns();
        $this->assertCount(0, $result['campaigns']);
    }

    /**
     * @throws GuzzleException
     */
    public function testGetSponsoredProductsCampaignsErrorMidLoop(): void
    {
        $response1 = [
            'campaigns' => [['campaignId' => 'c1']],
            'nextToken' => 'next_token'
        ];
        $mock = new MockHandler([
            new Response(200, [], json_encode(['access_token' => 'mock_token'])),
            new Response(200, [], json_encode($response1)),
            new Response(500, [], 'Internal Server Error'),
        ]);
        $this->adsApi->setGuzzleClient($this->createMockedGuzzleClient($mock));

        $this->expectException(\Anibalealvarezs\ApiSkeleton\Classes\Exceptions\ApiRequestException::class);
        $this->adsApi->getSponsoredProductsCampaignsAndProcess(function ($data) {});
    }
}

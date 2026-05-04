<?php

namespace Tests\Unit;

use Anibalealvarezs\AmazonApi\Amazon\AmazonApi;
use Anibalealvarezs\AmazonApi\Amazon\Support\AmazonErrorClassifier;
use Faker\Factory as Faker;
use Faker\Generator;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class AmazonErrorHandlingTest extends TestCase
{
    protected Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    protected function createMockedAmazonClient(array $responses): AmazonApi
    {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        $guzzle = new GuzzleClient(['handler' => $handler]);

        return new AmazonApi(
            baseUrl: 'https://advertising-api.amazon.com',
            redirectUrl: 'https://example.com/callback',
            clientId: $this->faker->uuid,
            clientSecret: $this->faker->uuid,
            refreshToken: $this->faker->uuid,
            token: 'dummy-token',
            guzzleClient: $guzzle,
        );
    }

    public function testAmazonSemanticRetryableFalsy200EventuallySucceeds(): void
    {
        $retryableBody = [
            'errors' => [
                [
                    'code' => 'TooManyRequests',
                    'message' => 'Rate exceeded for operation.',
                ],
            ],
        ];
        $successBody = ['campaigns' => []];

        $client = $this->createMockedAmazonClient([
            new Response(200, [], json_encode($retryableBody)),
            new Response(200, [], json_encode($successBody)),
        ]);

        $response = $client->performRequest('GET', '/test');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(is_callable($client->getRateLimitDetector()));
    }

    public function testAmazonErrorClassifierRecognizesThrottlingSignals(): void
    {
        $classification = AmazonErrorClassifier::classify([
            'errors' => [
                [
                    'code' => 'RequestThrottled',
                    'message' => 'Too many requests. Please retry.',
                ],
            ],
            'status' => 429,
        ]);

        $this->assertSame('retryable', $classification['category']);
        $this->assertTrue($classification['should_retry']);
    }
}


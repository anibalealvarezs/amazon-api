<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner;

use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Anibalealvarezs\AmazonApi\Amazon\AmazonApi;

class SellingPartnerApi extends AmazonApi
{
    /**
     * @param string $redirectUrl
     * @param string $clientId
     * @param string $clientSecret
     * @param string $refreshToken
     * @param array $scopes
     * @param string $token
     * @throws GuzzleException
     */
    public function __construct(
        string $redirectUrl,
        string $clientId,
        string $clientSecret,
        string $refreshToken,
        array $scopes = [],
        string $token = "",
    ) {
        parent::__construct(
            baseUrl: "https://sellingpartnerapi-na.amazon.com",
            redirectUrl: $redirectUrl,
            clientId: $clientId,
            clientSecret: $clientSecret,
            refreshToken: $refreshToken,
            scopes: ($scopes ?: ["sellingpartnerapi::notifications"]),
            token: $token,
            authSettings: [
                'location' => 'header',
                'headerPrefix' => '',
                'name' => 'x-amz-access-token',
            ],
            defaultHeaders: [
                "user-agent" => "CHMW/AmazonApi/SellingPartnerApi (Language=PHP/8.1.0)",
                "x-amz-date" => Carbon::now()->format("YYYYMMDDTHHMMSS")."Z",
            ],
        );
    }
}

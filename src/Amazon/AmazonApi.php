<?php

namespace Anibalealvarezs\AmazonApi\Amazon;

use Anibalealvarezs\ApiSkeleton\Clients\OAuthV2Client;
use GuzzleHttp\Exception\GuzzleException;

class AmazonApi extends OAuthV2Client
{
    /**
     * @param string $baseUrl
     * @param string $redirectUrl
     * @param string $clientId
     * @param string $clientSecret
     * @param string $refreshToken
     * @param array $scopes
     * @param string $token
     * @param array $authSettings
     * @param array $defaultHeaders
     * @throws GuzzleException
     */
    public function __construct(
        string $baseUrl,
        string $redirectUrl,
        string $clientId,
        string $clientSecret,
        string $refreshToken,
        array $scopes = [],
        string $token = "",
        array $authSettings = [
            'location' => 'header',
            'headerPrefix' => 'Bearer ',
        ],
        array $defaultHeaders = [],
    ) {
        return parent::__construct(
            baseUrl: $baseUrl,
            authUrl: "https://www.amazon.com/ap/oa",
            tokenUrl: "https://api.amazon.com/auth/o2/token",
            refreshAuthUrl: "https://www.amazon.com/ap/oa",
            redirectUrl: $redirectUrl,
            clientId: $clientId,
            clientSecret: $clientSecret,
            refreshToken: $refreshToken,
            authSettings: $authSettings,
            defaultHeaders: $defaultHeaders,
            refreshTokenHeaders: [
                "Content-Type" => "application/x-www-form-urlencoded;charset=UTF-8",
            ],
            scopes: $scopes,
            token: $token,
        );
    }

    /**
     * @return string|null
     * @throws GuzzleException
     */
    protected function getNewToken(): ?string
    {
        $form_params = [
            "client_id" => $this->clientId,
            "client_secret" => $this->clientSecret,
            "refresh_token" => $this->refreshToken,
            "grant_type" => "refresh_token",
        ];

        $response = $this->performRequest(
            method: "POST",
            endpoint: "",
            form_params: $form_params,
            baseUrl: $this->tokenUrl,
            headers: $this->refreshTokenHeaders,
            allowNewToken: false,
            ignoreAuth: true,
        );
        $data = json_decode($response->getBody()->getContents());

        return $data->access_token;
    }
}

<?php

namespace Anibalealvarezs\AmazonApi\Services\Ads\Enums;

enum GroupBy: string
{
    case campaign = 'campaign';
    case adGroup = 'adGroup';
    case campaignPlacement = 'campaignPlacement';
    case targeting = 'targeting';
    case searchTerm = 'searchTerm';
    case advertiser = 'advertiser';
    case asin = 'asin';
    case purchasedAsin = 'purchasedAsin';

    /**
     * @param ReportType $type
     * @param AdType $adProduct
     * @return array
     */
    public static function getListFor(
        ReportType $type,
        AdType $adProduct = AdType::SPONSORED_PRODUCTS
    ): array {
        return match($type) {
            ReportType::Campaign => [
                self::campaign,
                self::adGroup,
                self::campaignPlacement,
            ],
            ReportType::Targeting => [
                self::targeting,
            ],
            ReportType::SearchTerm => [
                self::searchTerm,
            ],
            ReportType::AdvertisedProduct => [
                self::advertiser,
            ],
            ReportType::PurchasedProduct => match($adProduct) {
                AdType::SPONSORED_PRODUCTS => [
                    self::asin,
                ],
                AdType::SPONSORED_BRANDS => [
                    self::purchasedAsin,
                ],
                default => [],
            },
            default => [],
        };  
    }
}

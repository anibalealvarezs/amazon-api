<?php

namespace Anibalealvarezs\AmazonApi\Services\Ads\Enums;

/**
 * @see https://advertising.amazon.com/API/docs/en-us/reporting/v3/report-types
 */
enum ReportType: string
{
    case Campaign = 'Campaign';
    case Targeting = 'Targeting';
    case SearchTerm = 'Search term';
    case AdvertisedProduct = 'Advertised product';
    case PurchasedProduct = 'Purchased product';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::Campaign,
            self::Targeting,
            self::SearchTerm,
            self::AdvertisedProduct,
            self::PurchasedProduct,
        ];
    }

    /**
     * @param AdType|null $adType
     * @return string
     */
    public function getId(
        AdType $adType = null
    ): string {
        return match($this) {
            self::Campaign => 'spCampaigns',
            self::Targeting => 'spTargeting',
            self::SearchTerm => 'spSearchTerm',
            self::AdvertisedProduct => 'spAdvertisedProduct',
            self::PurchasedProduct => $adType && $adType === AdType::SPONSORED_BRANDS ? 'sbPurchasedProduct' : 'spPurchasedProduct',
        };
    }
}

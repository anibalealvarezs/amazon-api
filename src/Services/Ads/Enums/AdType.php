<?php

namespace Anibalealvarezs\AmazonApi\Services\Ads\Enums;

enum AdType: string
{
    case SPONSORED_PRODUCTS = 'SPONSORED_PRODUCTS';
    case SPONSORED_BRANDS = 'SPONSORED_BRANDS';
    case SPONSORED_DISPLAY = 'SPONSORED_DISPLAY';

    public function getPrefix(): string
    {
        return match($this) {
            self::SPONSORED_PRODUCTS => 'sp',
            self::SPONSORED_BRANDS => 'sb',
            self::SPONSORED_DISPLAY => 'sd',
        };
    }
}

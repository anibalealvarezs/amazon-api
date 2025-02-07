<?php

namespace Anibalealvarezs\AmazonApi\Services\Ads\Enums;

enum Metric: string
{
    case SPONSORED_PRODUCTS = 'sp';
    case SPONSORED_BRANDS = 'sb';
    case SPONSORED_DISPLAY = 'sd';

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->value;
    }
}

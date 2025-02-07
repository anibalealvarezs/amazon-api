<?php

namespace Anibalealvarezs\AmazonApi\Services\SellingPartner\Enums\ReportTypes\BrowseTree;

use Anibalealvarezs\AmazonApi\Services\SellingPartner\Interfaces\ReportOptions;

/**
 * @see https://developer-docs.amazon.com/sp-api/docs/report-type-values-browse-tree
 */
enum BrowseTree: string implements ReportOptions
{
    case GET_XML_BROWSE_TREE_DATA = 'GET_XML_BROWSE_TREE_DATA';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::GET_XML_BROWSE_TREE_DATA,
        ];
    }

    /**
     * @return array
     */
    public function getReportOptions(): array
    {
        return [];
    }
}

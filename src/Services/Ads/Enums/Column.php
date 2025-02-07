<?php

namespace Anibalealvarezs\AmazonApi\Services\Ads\Enums;

/**
 * @see https://advertising.amazon.com/API/docs/en-us/reporting/v3/metrics
 */
enum Column: string
{
    case acosClicks14d = 'acosClicks14d';
    case acosClicks7d = 'acosClicks7d';
    case adGroupId = 'adGroupId';
    case adGroupName = 'adGroupName';
    case adId = 'adId';
    case adKeywordStatus = 'adKeywordStatus';
    case adStatus = 'adStatus';
    case advertisedAsin = 'advertisedAsin';
    case advertisedSku = 'advertisedSku';
    case attributedSalesSameSku14d = 'attributedSalesSameSku14d';
    case attributedSalesSameSku1d = 'attributedSalesSameSku1d';
    case attributedSalesSameSku30d = 'attributedSalesSameSku30d';
    case attributedSalesSameSku7d = 'attributedSalesSameSku7d';
    case attributionType = 'attributionType';
    case campaignApplicableBudgetRuleId = 'campaignApplicableBudgetRuleId';
    case campaignApplicableBudgetRuleName = 'campaignApplicableBudgetRuleName';
    case campaignBiddingStrategy = 'campaignBiddingStrategy';
    case campaignBudgetAmount = 'campaignBudgetAmount';
    case campaignBudgetCurrencyCode = 'campaignBudgetCurrencyCode';
    case campaignBudgetType = 'campaignBudgetType';
    case campaignId = 'campaignId';
    case campaignName = 'campaignName';
    case campaignRuleBasedBudgetAmount = 'campaignRuleBasedBudgetAmount';
    case campaignStatus = 'campaignStatus';
    case clicks = 'clicks';
    case clickThroughRate = 'clickThroughRate';
    case cost = 'cost';
    case costPerClick = 'costPerClick';
    case date = 'date';
    case endDate = 'endDate';
    case impressions = 'impressions';
    case keyword = 'keyword';
    case keywordBid = 'keywordBid';
    case keywordId = 'keywordId';
    case keywordType = 'keywordType';
    case kindleEditionNormalizedPagesRead14d = 'kindleEditionNormalizedPagesRead14d';
    case kindleEditionNormalizedPagesRoyalties14d = 'kindleEditionNormalizedPagesRoyalties14d';
    case matchType = 'matchType';
    case newToBrandPurchases14d = 'newToBrandPurchases14d';
    case newToBrandPurchasesPercentage14d = 'newToBrandPurchasesPercentage14d';
    case newToBrandSales14d = 'newToBrandSales14d';
    case newToBrandSalesPercentage14d = 'newToBrandSalesPercentage14d';
    case newToBrandUnitsSold14d = 'newToBrandUnitsSold14d';
    case newToBrandUnitsSoldPercentage14d = 'newToBrandUnitsSoldPercentage14d';
    case orders14d = 'orders14d';
    case placementClassification = 'placementClassification';
    case portfolioId = 'portfolioId';
    case productCategory = 'productCategory';
    case productName = 'productName';
    case purchasedAsin = 'purchasedAsin';
    case purchases14d = 'purchases14d';
    case purchases1d = 'purchases1d';
    case purchases30d = 'purchases30d';
    case purchases7d = 'purchases7d';
    case purchasesOtherSku14d = 'purchasesOtherSku14d';
    case purchasesOtherSku1d = 'purchasesOtherSku1d';
    case purchasesOtherSku30d = 'purchasesOtherSku30d';
    case purchasesOtherSku7d = 'purchasesOtherSku7d';
    case purchasesSameSku14d = 'purchasesSameSku14d';
    case purchasesSameSku1d = 'purchasesSameSku1d';
    case purchasesSameSku30d = 'purchasesSameSku30d';
    case purchasesSameSku7d = 'purchasesSameSku7d';
    case roasClicks14d = 'roasClicks14d';
    case roasClicks7d = 'roasClicks7d';
    case sales14d = 'sales14d';
    case sales1d = 'sales1d';
    case sales30d = 'sales30d';
    case sales7d = 'sales7d';
    case salesOtherSku14d = 'salesOtherSku14d';
    case salesOtherSku1d = 'salesOtherSku1d';
    case salesOtherSku30d = 'salesOtherSku30d';
    case salesOtherSku7d = 'salesOtherSku7d';
    case searchTerm = 'searchTerm';
    case spend = 'spend';
    case startDate = 'startDate';
    case targeting = 'targeting';
    case unitsSold14d = 'unitsSold14d';
    case unitsSoldClicks14d = 'unitsSoldClicks14d';
    case unitsSoldClicks1d = 'unitsSoldClicks1d';
    case unitsSoldClicks30d = 'unitsSoldClicks30d';
    case unitsSoldClicks7d = 'unitsSoldClicks7d';
    case unitsSoldOtherSku14d = 'unitsSoldOtherSku14d';
    case unitsSoldOtherSku1d = 'unitsSoldOtherSku1d';
    case unitsSoldOtherSku30d = 'unitsSoldOtherSku30d';
    case unitsSoldOtherSku7d = 'unitsSoldOtherSku7d';
    case unitsSoldSameSku14d = 'unitsSoldSameSku14d';
    case unitsSoldSameSku1d = 'unitsSoldSameSku1d';
    case unitsSoldSameSku30d = 'unitsSoldSameSku30d';
    case unitsSoldSameSku7d = 'unitsSoldSameSku7d';

    /**
     * @param Column $column
     * @return array
     */
    public static function getReportTypesForColumn(
        self $column
    ): array {
        $list = [];
        foreach (ReportType::getValues() as $type) {
            if (in_array($column->value, self::getListFor($type))) {
                $list[] = $type;
            }
        }
        return $list;
    }

    /**
     * @param ReportType $type
     * @param array $groupBy
     * @return array
     */
    public static function getListFor(
        ReportType $type,
        array $groupBy = []
    ): array {
        return match($type) {
            ReportType::Campaign => self::getListForCampaign(groupBy: $groupBy),
            ReportType::Targeting => self::getListForTargeting(groupBy: $groupBy),
            ReportType::SearchTerm => self::getListForSearchTerm(groupBy: $groupBy),
            ReportType::AdvertisedProduct => self::getListForAdvertisedProduct(),
            ReportType::PurchasedProduct => self::getListForPurchasedProduct(),
            default => [],
        };
    }

    /**
     * @param array $groupBy
     * @return array
     */
    public static function getListForCampaign(
        array $groupBy = []
    ): array {
        $columns = [
            self::attributedSalesSameSku14d->value,
            self::attributedSalesSameSku1d->value,
            self::attributedSalesSameSku30d->value,
            self::attributedSalesSameSku7d->value,
            self::campaignBiddingStrategy->value,
            self::clicks->value,
            self::clickThroughRate->value,
            self::cost->value,
            self::costPerClick->value,
            self::date->value,
            self::endDate->value,
            self::impressions->value,
            self::kindleEditionNormalizedPagesRead14d->value,
            self::kindleEditionNormalizedPagesRoyalties14d->value,
            self::purchases14d->value,
            self::purchases1d->value,
            self::purchases30d->value,
            self::purchases7d->value,
            self::purchasesSameSku14d->value,
            self::purchasesSameSku1d->value,
            self::purchasesSameSku30d->value,
            self::purchasesSameSku7d->value,
            self::sales14d->value,
            self::sales1d->value,
            self::sales30d->value,
            self::sales7d->value,
            self::spend->value,
            self::startDate->value,
            self::unitsSoldClicks14d->value,
            self::unitsSoldClicks1d->value,
            self::unitsSoldClicks30d->value,
            self::unitsSoldClicks7d->value,
        ];

        foreach($groupBy as $group) {            
            $columns = [...$columns, match($group){
                GroupBy::campaign => [
                    self::campaignId->value,
                    self::campaignName->value,
                    self::campaignBudgetAmount->value,
                    self::campaignRuleBasedBudgetAmount->value,
                    self::campaignStatus->value,
                    self::campaignBudgetType->value,
                    self::campaignApplicableBudgetRuleId->value,
                    self::campaignApplicableBudgetRuleName->value,
                    self::campaignBudgetCurrencyCode->value,
                ],
                GroupBy::adGroup => [
                    self::adGroupName->value,
                    self::adGroupId->value,
                    self::adStatus->value,
                ],
                GroupBy::campaignPlacement => [
                    self::placementClassification->value,
                ],
            }];
        }

        return $columns;
    }

    /**
     * @param array $groupBy
     * @return array
     */
    public static function getListForTargeting(
        array $groupBy = []
    ): array {
        $columns = [
            self::acosClicks14d->value,
            self::acosClicks7d->value,
            self::adGroupId->value,
            self::adGroupName->value,
            self::attributedSalesSameSku14d->value,
            self::attributedSalesSameSku1d->value,
            self::attributedSalesSameSku30d->value,
            self::attributedSalesSameSku7d->value,
            self::campaignBudgetAmount->value,
            self::campaignBudgetCurrencyCode->value,
            self::campaignBudgetType->value,
            self::campaignId->value,
            self::campaignName->value,
            self::campaignStatus->value,
            self::clicks->value,
            self::clickThroughRate->value,
            self::cost->value,
            self::costPerClick->value,
            self::date->value,
            self::endDate->value,
            self::impressions->value,
            self::keyword->value,
            self::keywordBid->value,
            self::keywordId->value,
            self::keywordType->value,
            self::kindleEditionNormalizedPagesRead14d->value,
            self::kindleEditionNormalizedPagesRoyalties14d->value,
            self::matchType->value,
            self::portfolioId->value,
            self::purchases14d->value,
            self::purchases1d->value,
            self::purchases30d->value,
            self::purchases7d->value,
            self::purchasesSameSku14d->value,
            self::purchasesSameSku1d->value,
            self::purchasesSameSku30d->value,
            self::purchasesSameSku7d->value,
            self::roasClicks14d->value,
            self::roasClicks7d->value,
            self::sales14d->value,
            self::sales1d->value,
            self::sales30d->value,
            self::sales7d->value,
            self::startDate->value,
            self::targeting->value,
            self::unitsSoldClicks14d->value,
            self::unitsSoldClicks1d->value,
            self::unitsSoldClicks30d->value,
            self::unitsSoldClicks7d->value,
            self::unitsSoldSameSku14d->value,
            self::unitsSoldSameSku1d->value,
            self::unitsSoldSameSku30d->value,
            self::unitsSoldSameSku7d->value,
        ];

        foreach($groupBy as $group) {            
            $columns = [...$columns, match($group){
                GroupBy::targeting => [
                    self::adKeywordStatus->value,
                ],
            }];
        }

        return $columns;
    }

    /**
     * @param array $groupBy
     * @return array
     */
    public static function getListForSearchTerm(
        array $groupBy = []
    ): array {
        $columns = [
            self::acosClicks14d->value,
            self::acosClicks7d->value,
            self::adGroupId->value,
            self::adGroupName->value,
            self::attributedSalesSameSku14d->value,
            self::attributedSalesSameSku1d->value,
            self::attributedSalesSameSku30d->value,
            self::attributedSalesSameSku7d->value,
            self::campaignBudgetAmount->value,
            self::campaignBudgetCurrencyCode->value,
            self::campaignBudgetType->value,
            self::campaignId->value,
            self::campaignName->value,
            self::campaignStatus->value,
            self::clicks->value,
            self::clickThroughRate->value,
            self::cost->value,
            self::costPerClick->value,
            self::date->value,
            self::endDate->value,
            self::impressions->value,
            self::keyword->value,
            self::keywordBid->value,
            self::keywordId->value,
            self::keywordType->value,
            self::kindleEditionNormalizedPagesRead14d->value,
            self::kindleEditionNormalizedPagesRoyalties14d->value,
            self::matchType->value,
            self::portfolioId->value,
            self::purchases14d->value,
            self::purchases1d->value,
            self::purchases30d->value,
            self::purchases7d->value,
            self::purchasesSameSku14d->value,
            self::purchasesSameSku1d->value,
            self::purchasesSameSku30d->value,
            self::purchasesSameSku7d->value,
            self::roasClicks14d->value,
            self::roasClicks7d->value,
            self::sales14d->value,
            self::sales1d->value,
            self::sales30d->value,
            self::sales7d->value,
            self::searchTerm->value,
            self::startDate->value,
            self::targeting->value,
            self::unitsSoldClicks14d->value,
            self::unitsSoldClicks1d->value,
            self::unitsSoldClicks30d->value,
            self::unitsSoldClicks7d->value,
            self::unitsSoldSameSku14d->value,
            self::unitsSoldSameSku1d->value,
            self::unitsSoldSameSku30d->value,
            self::unitsSoldSameSku7d->value,
        ];

        foreach($groupBy as $group) {            
            $columns = [...$columns, match($group){
                GroupBy::targeting => [
                    self::adKeywordStatus->value,
                ],
            }];
        }

        return $columns;
    }

    /**
     * @return array
     */
    public static function getListForAdvertisedProduct(): array {
        return [
            self::acosClicks14d->value,
            self::acosClicks7d->value,
            self::adGroupId->value,
            self::adGroupName->value,
            self::adId->value,
            self::advertisedAsin->value,
            self::advertisedSku->value,
            self::attributedSalesSameSku14d->value,
            self::attributedSalesSameSku1d->value,
            self::attributedSalesSameSku30d->value,
            self::attributedSalesSameSku7d->value,
            self::campaignBudgetAmount->value,
            self::campaignBudgetCurrencyCode->value,
            self::campaignBudgetType->value,
            self::campaignId->value,
            self::campaignName->value,
            self::campaignStatus->value,
            self::clicks->value,
            self::clickThroughRate->value,
            self::cost->value,
            self::costPerClick->value,
            self::date->value,
            self::endDate->value,
            self::impressions->value,
            self::kindleEditionNormalizedPagesRead14d->value,
            self::kindleEditionNormalizedPagesRoyalties14d->value,
            self::portfolioId->value,
            self::purchases14d->value,
            self::purchases1d->value,
            self::purchases30d->value,
            self::purchases7d->value,
            self::purchasesSameSku14d->value,
            self::purchasesSameSku1d->value,
            self::purchasesSameSku30d->value,
            self::purchasesSameSku7d->value,
            self::roasClicks14d->value,
            self::roasClicks7d->value,
            self::sales14d->value,
            self::sales1d->value,
            self::sales30d->value,
            self::sales7d->value,
            self::spend->value,
            self::startDate->value,
            self::unitsSoldClicks14d->value,
            self::unitsSoldClicks1d->value,
            self::unitsSoldClicks30d->value,
            self::unitsSoldClicks7d->value,
            self::unitsSoldSameSku14d->value,
            self::unitsSoldSameSku1d->value,
            self::unitsSoldSameSku30d->value,
            self::unitsSoldSameSku7d->value,
        ];
    }

    /**
     * @return array
     */
    public static function getListForPurchasedProduct(): array {
        return [
            self::adGroupId->value,
            self::adGroupName->value,
            self::advertisedAsin->value,
            self::advertisedSku->value,
            self::attributionType->value,
            self::campaignBudgetCurrencyCode->value,
            self::campaignId->value,
            self::campaignName->value,
            self::date->value,
            self::endDate->value,
            self::keyword->value,
            self::keywordId->value,
            self::keywordType->value,
            self::kindleEditionNormalizedPagesRead14d->value,
            self::kindleEditionNormalizedPagesRoyalties14d->value,
            self::matchType->value,
            self::newToBrandPurchases14d->value,
            self::newToBrandPurchasesPercentage14d->value,
            self::newToBrandSales14d->value,
            self::newToBrandSalesPercentage14d->value,
            self::newToBrandUnitsSold14d->value,
            self::newToBrandUnitsSoldPercentage14d->value,
            self::orders14d->value,
            self::portfolioId->value,
            self::productCategory->value,
            self::productName->value,
            self::purchasedAsin->value,
            self::purchases14d->value,
            self::purchases1d->value,
            self::purchases30d->value,
            self::purchases7d->value,
            self::purchasesOtherSku14d->value,
            self::purchasesOtherSku1d->value,
            self::purchasesOtherSku30d->value,
            self::purchasesOtherSku7d->value,
            self::sales14d->value,
            self::sales1d->value,
            self::sales30d->value,
            self::sales7d->value,
            self::salesOtherSku14d->value,
            self::salesOtherSku1d->value,
            self::salesOtherSku30d->value,
            self::salesOtherSku7d->value,
            self::startDate->value,
            self::targeting->value,
            self::unitsSold14d->value,
            self::unitsSoldClicks14d->value,
            self::unitsSoldClicks1d->value,
            self::unitsSoldClicks30d->value,
            self::unitsSoldClicks7d->value,
            self::unitsSoldOtherSku14d->value,
            self::unitsSoldOtherSku1d->value,
            self::unitsSoldOtherSku30d->value,
            self::unitsSoldOtherSku7d->value,
            self::unitsSoldSameSku14d->value,
            self::unitsSoldSameSku1d->value,
            self::unitsSoldSameSku30d->value,
            self::unitsSoldSameSku7d->value,
        ];
    }
}

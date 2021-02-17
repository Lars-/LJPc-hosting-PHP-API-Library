<?php

namespace LJPcHosting\v1\Hydrators;

use DateTime;
use LJPcHosting\v1\Models\ValuePack;

class ValuePackHydrator extends ValuePack {
    public static function hydrate(array $data, ValuePack $valuePack): void {
        $valuePack->reference = $data['reference'];
        $valuePack->owner     = $data['owner'];

        $valuePack->subscription                            = $data['subscription'];
        $valuePack->freeDomains                             = $data['freeDomains'];
        $valuePack->purchasePriceDomains                    = $data['purchasePriceDomains'];
        $valuePack->domainDiscountPercentage                = $data['domainDiscountPercentage'];
        $valuePack->domainPriceAbovePurchasePrice           = $data['domainPriceAbovePurchasePrice'];
        $valuePack->dedicatedHostingDiscountPercentage      = $data['dedicatedHostingDiscountPercentage'];
        $valuePack->dedicatedHostingPriceAbovePurchasePrice = $data['dedicatedHostingPriceAbovePurchasePrice'];
        $valuePack->sharedHostingDiscountPercentage         = $data['sharedHostingDiscountPercentage'];
        $valuePack->sharedHostingPriceAbovePurchasePrice    = $data['sharedHostingPriceAbovePurchasePrice'];

        $valuePack->createdAt = DateTime::createFromFormat(DATE_ATOM, $data['createdAt']);
        $valuePack->updatedAt = DateTime::createFromFormat(DATE_ATOM, $data['updatedAt']);
    }

    public static function extract(ValuePack $valuePack): array {
        return [
            'reference' => $valuePack->reference,
            'owner'     => $valuePack->owner,

            'subscription'                            => $valuePack->subscription,
            'freeDomains'                             => $valuePack->freeDomains,
            'purchasePriceDomains'                    => $valuePack->purchasePriceDomains,
            'domainDiscountPercentage'                => $valuePack->domainDiscountPercentage,
            'domainPriceAbovePurchasePrice'           => $valuePack->domainPriceAbovePurchasePrice,
            'dedicatedHostingDiscountPercentage'      => $valuePack->dedicatedHostingDiscountPercentage,
            'dedicatedHostingPriceAbovePurchasePrice' => $valuePack->dedicatedHostingPriceAbovePurchasePrice,
            'sharedHostingDiscountPercentage'         => $valuePack->sharedHostingDiscountPercentage,
            'sharedHostingPriceAbovePurchasePrice'    => $valuePack->sharedHostingPriceAbovePurchasePrice,

            'createdAt' => $valuePack->createdAt->format(DATE_ATOM),
            'updatedAt' => $valuePack->updatedAt->format(DATE_ATOM),
        ];
    }
}
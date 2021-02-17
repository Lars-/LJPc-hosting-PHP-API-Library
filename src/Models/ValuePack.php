<?php

namespace LJPcHosting\v1\Models;

use DateTime;
use LJPcHosting\v1\API;

class ValuePack {
    protected string $reference;
    protected DateTime $createdAt;
    protected DateTime $updatedAt;
    protected string $owner;
    protected string $subscription;
    protected float $domainDiscountPercentage;
    protected float $domainPriceAbovePurchasePrice;
    protected float $dedicatedHostingDiscountPercentage;
    protected float $dedicatedHostingPriceAbovePurchasePrice;
    protected float $sharedHostingDiscountPercentage;
    protected float $sharedHostingPriceAbovePurchasePrice;
    protected int $freeDomains;
    protected int $purchasePriceDomains;

    public function getReference(): string {
        return $this->reference;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    public function getOwnerReference(): string {
        return $this->owner;
    }

    public function getOwner(): User {
        return API::instance()->users()->get($this->owner);
    }

    public function getSubscriptionReference(): string {
        return $this->subscription;
    }

    public function getSubscription(): Subscription {
        return API::instance()->subscriptions()->get($this->subscription);
    }

    public function getDomainDiscountPercentage(): float {
        return $this->domainDiscountPercentage;
    }

    public function getDomainPriceAbovePurchasePrice(): float {
        return $this->domainPriceAbovePurchasePrice;
    }

    public function getDedicatedHostingDiscountPercentage(): float {
        return $this->dedicatedHostingDiscountPercentage;
    }

    public function getDedicatedHostingPriceAbovePurchasePrice(): float {
        return $this->dedicatedHostingPriceAbovePurchasePrice;
    }

    public function getSharedHostingDiscountPercentage(): float {
        return $this->sharedHostingDiscountPercentage;
    }

    public function getSharedHostingPriceAbovePurchasePrice(): float {
        return $this->sharedHostingPriceAbovePurchasePrice;
    }

    public function getFreeDomains(): int {
        return $this->freeDomains;
    }

    public function getPurchasePriceDomains(): int {
        return $this->purchasePriceDomains;
    }
}
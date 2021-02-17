<?php

namespace LJPcHosting\v1\Models;

use DateTime;
use LJPcHosting\v1\API;

class Subscription {
    protected string $reference;
    protected string $owner;
    protected string $name;
    protected string $frequency;
    protected DateTime $initialDate;
    protected ?DateTime $validUntil;
    protected float $price;
    protected float $originalPrice;
    protected bool $active;
    protected string $productType;
    protected string $productReference;
    protected DateTime $createdAt;
    protected DateTime $updatedAt;

    public function getReference(): string {
        return $this->reference;
    }

    public function getOwnerReference(): string {
        return $this->owner;
    }

    public function getOwner(): User {
        return API::instance()->users()->get($this->owner);
    }

    public function getName(): string {
        return $this->name;
    }

    public function getFrequency(): string {
        return $this->frequency;
    }

    public function getInitialDate(): DateTime {
        return $this->initialDate;
    }

    public function getValidUntil(): ?DateTime {
        return $this->validUntil;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getOriginalPrice(): float {
        return $this->originalPrice;
    }

    public function isActive(): bool {
        return $this->active;
    }

    public function getProduct() {
        //TODO : implement
    }

    public function getProductType(): string {
        return $this->productType;
    }

    public function getProductReference(): string {
        return $this->productReference;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }
}
<?php

namespace LJPcHosting\v1\Models;

use DateTime;
use LJPcHosting\v1\API;
use LJPcHosting\v1\Hydrators\DedicatedHostingHydrator;

class DedicatedHosting {
    protected string $reference;
    protected DateTime $createdAt;
    protected DateTime $updatedAt;
    protected string $owner;
    protected string $subscription;
    protected string $hostname;
    protected string $username;
    protected int $diskQuotaBytes;
    protected int $trafficQuotaBytes;
    protected string $status;
    protected array $domainNames;
    protected array $ipv4Addresses;
    protected int $maxDomains;

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

    public function getHostname(): string {
        return $this->hostname;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getDiskQuotaBytes(): int {
        return $this->diskQuotaBytes;
    }

    public function getTrafficQuotaBytes(): int {
        return $this->trafficQuotaBytes;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getDomainNames(): array {
        return $this->domainNames;
    }

    public function getIpv4Addresses(): array {
        return $this->ipv4Addresses;
    }

    public function getMaxDomains(): int {
        return $this->maxDomains;
    }

    public function getLoginUrl(): string {
        $response = API::instance()->call('GET', '/dedicated_hosting/' . $this->reference . '/login');

        return $response['url'];
    }

    public function connectDomainName(DomainName $domainName): self {
        $response = API::instance()->call('POST', '/dedicated_hosting/' . $this->reference . '/connect_domain_name', [
            'domainReference' => $domainName->getReference(),
        ]);

        $newHosting = new self;
        DedicatedHostingHydrator::hydrate($response, $newHosting);

        return $newHosting;
    }
}
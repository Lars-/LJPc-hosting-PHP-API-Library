<?php

namespace LJPcHosting\v1\Models;

use DateTime;
use LJPcHosting\v1\API;

class DomainName {
    protected string $reference;
    protected DateTime $createdAt;
    protected DateTime $updatedAt;
    protected string $owner;
    protected string $subscription;
    protected string $hostname;
    protected string $domainOwnerReference;
    protected string $nameserverGroupReference;
    protected string $hostingReference;
    protected string $status;
    protected ?string $authCode = null;

    public function getHostingReference(): string {
        return $this->hostingReference;
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

    public function getSubscription(): string {
        return API::instance()->subscriptions()->get($this->subscription);
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    public function getHostname(): string {
        return $this->hostname;
    }

    public function getDomainOwnerReference(): string {
        return $this->domainOwnerReference;
    }

    public function setDomainOwnerReference(string $domainOwnerReference): DomainName {
        $this->domainOwnerReference = $domainOwnerReference;

        return $this;
    }

    public function getNameserverGroupReference(): string {
        return $this->nameserverGroupReference;
    }

    public function setNameserverGroupReference(string $nameserverGroupReference): DomainName {
        $this->nameserverGroupReference = $nameserverGroupReference;

        return $this;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getAuthCode(string $reference): string {
        if ($this->authCode === null) {
            $authCodeResponse = API::instance()->call('GET', "/domain_names/$reference/auth_code");
            $this->authCode   = $authCodeResponse['authCode'];
        }

        return $this->authCode;
    }

    public function register(): DomainName {
        API::instance()->call('POST', "/domain_names/" . $this->getReference() . '/register');

        return $this;
    }

    public function getReference(): string {
        return $this->reference;
    }

    public function transfer(string $authCode): DomainName {
        API::instance()->call('POST', "/domain_names/" . $this->getReference() . '/transfer', [
            'authCode' => $authCode,
        ]);

        return $this;
    }
}
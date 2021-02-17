<?php

namespace LJPcHosting\v1\Models;

use DateTime;
use LJPcHosting\v1\API;

class DomainOwner {
    protected string $reference;
    protected string $owner;
    protected DateTime $createdAt;
    protected DateTime $updatedAt;
    protected string $companyName;
    protected string $firstName;
    protected string $lastName;
    protected string $phoneNumber;
    protected string $emailAddress;
    protected string $street;
    protected string $number;
    protected ?string $suffix;
    protected string $zipCode;
    protected string $city;
    protected string $country;

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getCompanyName(): string {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): DomainOwner {
        $this->companyName = $companyName;

        return $this;
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): DomainOwner {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmailAddress(): string {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): DomainOwner {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    public function getStreet(): string {
        return $this->street;
    }

    public function setStreet(string $street): DomainOwner {
        $this->street = $street;

        return $this;
    }

    public function getNumber(): string {
        return $this->number;
    }

    public function setNumber(string $number): DomainOwner {
        $this->number = $number;

        return $this;
    }

    public function getSuffix(): ?string {
        return $this->suffix;
    }

    public function setSuffix(?string $suffix): DomainOwner {
        $this->suffix = $suffix;

        return $this;
    }

    public function getZipCode(): string {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): DomainOwner {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function setCity(string $city): DomainOwner {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function setCountry(string $country): DomainOwner {
        $this->country = $country;

        return $this;
    }

    public function getReference(): string {
        return $this->reference;
    }

    public function getOwnerReference(): string {
        return $this->owner;
    }

    public function getOwner(): User {
        return API::instance()->users()->get($this->owner);
    }
}
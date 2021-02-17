<?php

namespace LJPcHosting\v1\Models;

use DateTime;

class User {
    protected string $reference;
    protected string $email;
    protected ?string $company;
    protected string $firstName;
    protected string $lastName;
    protected string $phoneNumber;
    protected string $street;
    protected string $number;
    protected ?string $suffix;
    protected string $zipcode;
    protected string $city;
    protected string $country;
    protected ?string $password;
    protected DateTime $lastLogin;
    protected DateTime $createdAt;
    protected DateTime $updatedAt;

    /**
     * @return string
     */
    public function getReference(): string {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string {
        return $this->company;
    }

    /**
     * @param string|null $company
     *
     * @return User
     */
    public function setCompany(?string $company): User {
        $this->company = $company;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName(string $firstName): User {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName(string $lastName): User {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber(string $phoneNumber): User {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet(): string {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return User
     */
    public function setStreet(string $street): User {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): string {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return User
     */
    public function setNumber(string $number): User {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSuffix(): ?string {
        return $this->suffix;
    }

    /**
     * @param string|null $suffix
     *
     * @return User
     */
    public function setSuffix(?string $suffix): User {
        $this->suffix = $suffix;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode(): string {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     *
     * @return User
     */
    public function setZipcode(string $zipcode): User {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return User
     */
    public function setCity(string $city): User {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return User
     */
    public function setCountry(string $country): User {
        $this->country = $country;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getLastLogin(): DateTime {
        return $this->lastLogin;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password): User {
        $this->password = $password;

        return $this;
    }
}
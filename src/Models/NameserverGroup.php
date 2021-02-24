<?php

namespace LJPcHosting\v1\Models;

use DateTime;
use LJPcHosting\v1\API;
use RuntimeException;

class NameserverGroup {
    protected string $reference;
    protected string $owner;
    protected DateTime $createdAt;
    protected DateTime $updatedAt;
    protected string $name;
    /**
     * @var Nameserver[]
     */
    protected array $nameservers;

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): NameserverGroup {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Nameserver[]
     */
    public function getNameservers(): array {
        return $this->nameservers;
    }

    /**
     * @param Nameserver[] $nameservers
     *
     * @return NameserverGroup
     */
    public function setNameservers(array $nameservers): NameserverGroup {
        foreach ($nameservers as $nameserver) {
            if ( ! ($nameserver instanceof Nameserver)) {
                throw new RuntimeException('No nameserver provided');
            }
        }
        $this->nameservers = $nameservers;

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

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }
}
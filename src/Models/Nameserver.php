<?php
namespace LJPcHosting\v1\Models;

use JetBrains\PhpStorm\ArrayShape;
use RuntimeException;

class Nameserver {
    protected string $hostname;
    protected string $ipv4;
    protected ?string $ipv6;

    public function __construct(string $hostname, string $ipv4, string $ipv6 = null) {
        $this->hostname = $hostname;
        $this->ipv4     = $ipv4;
        $this->ipv6     = $ipv6;

        $this->validate();
    }

    private function validate(): void {
        if (empty(trim($this->hostname))) {
            throw new RuntimeException('Hostname can not be empty');
        }
        if ( ! filter_var($this->ipv4, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            throw new RuntimeException($this->ipv4 . ' is not a valid IPv4 address');
        }
        if ($this->ipv6 !== null && ! filter_var($this->ipv6, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            throw new RuntimeException($this->ipv6 . ' is not a valid IPv6 address');
        }
    }

    public function getHostname(): string {
        return $this->hostname;
    }

    public function setHostname(string $hostname): Nameserver {
        $this->hostname = $hostname;

        $this->validate();

        return $this;
    }

    public function getIpv4(): string {
        return $this->ipv4;
    }

    public function setIpv4(string $ipv4): Nameserver {
        $this->ipv4 = $ipv4;

        $this->validate();

        return $this;
    }

    public function getIpv6(): ?string {
        return $this->ipv6;
    }

    public function setIpv6(?string $ipv6): Nameserver {
        $this->ipv6 = $ipv6;

        $this->validate();

        return $this;
    }

    #[ArrayShape(['hostname' => "string", 'ipv4' => "string", 'ipv6' => "null|string"])] public function toArray(): array {
        return [
            'hostname' => $this->hostname,
            'ipv4'     => $this->ipv4,
            'ipv6'     => $this->ipv6,
        ];
    }
}
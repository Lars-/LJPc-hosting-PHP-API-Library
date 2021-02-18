<?php

namespace LJPcHosting\v1;

use LJPcHosting\v1\Endpoints\DedicatedHosting;
use LJPcHosting\v1\Endpoints\DomainNames;
use LJPcHosting\v1\Endpoints\DomainOwners;
use LJPcHosting\v1\Endpoints\NameserverGroups;
use LJPcHosting\v1\Endpoints\SharedHosting;
use LJPcHosting\v1\Endpoints\Subscriptions;
use LJPcHosting\v1\Endpoints\Users;
use LJPcHosting\v1\Endpoints\ValuePacks;
use RuntimeException;

class API {
    protected static self $instance;
    protected string $apiUrl = 'https://api.ljpc-hosting.nl/v1';
    protected string $apiKey;

    public static function instance(): self {
        if ( ! isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function call(string $method, string $url, array $data = [], array $extraHeaders = []): array {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $this->apiUrl . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_POSTFIELDS     => json_encode($data, JSON_THROW_ON_ERROR),
            CURLOPT_HTTPHEADER     => array_merge([
                'X-LJPc-API-Key: ' . $this->apiKey,
                'Content-Type: application/json',
            ], $extraHeaders),
        ]);

        $response = curl_exec($curl);

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ((int)$httpCode !== 200) {
            throw new RuntimeException("[$httpCode] Something went wrong: $response", $httpCode);
        }

        curl_close($curl);

        return json_decode($response, true, 512, JSON_THROW_ON_ERROR);
    }

    public function connect(string $apiKey): void {
        $this->apiKey = $apiKey;
    }

    public function users(): Users {
        return Users::instance();
    }

    public function domainNames(): DomainNames {
        return DomainNames::instance();
    }

    public function domainOwners(): DomainOwners {
        return DomainOwners::instance();
    }

    public function nameserverGroups(): NameserverGroups {
        return NameserverGroups::instance();
    }

    public function subscriptions(): Subscriptions {
        return Subscriptions::instance();
    }

    public function dedicatedHosting(): DedicatedHosting {
        return DedicatedHosting::instance();
    }

    public function sharedHosting(): SharedHosting {
        return SharedHosting::instance();
    }

    public function valuePacks(): ValuePacks {
        return ValuePacks::instance();
    }

    public function overrideAPIUrl(string $apiUrl): void {
        $this->apiUrl = $apiUrl;
    }
}
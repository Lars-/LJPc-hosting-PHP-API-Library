<?php

namespace LJPcHosting\v1\Hydrators;

use DateTime;
use LJPcHosting\v1\Models\DedicatedHosting;

class DedicatedHostingHydrator extends DedicatedHosting {
    public static function hydrate(array $data, DedicatedHosting $dedicatedHosting): void {
        $dedicatedHosting->reference = $data['reference'];
        $dedicatedHosting->owner     = $data['owner'];

        $dedicatedHosting->subscription      = $data['subscription'];
        $dedicatedHosting->hostname          = $data['hostname'];
        $dedicatedHosting->username          = $data['username'];
        $dedicatedHosting->diskQuotaBytes    = $data['diskQuotaBytes'];
        $dedicatedHosting->trafficQuotaBytes = $data['trafficQuotaBytes'];
        $dedicatedHosting->status            = $data['status'];
        $dedicatedHosting->domainNames       = $data['domainNames'];
        $dedicatedHosting->ipv4Addresses     = $data['ipv4Addresses'];
        $dedicatedHosting->maxDomains        = $data['maxDomains'];

        $dedicatedHosting->createdAt = DateTime::createFromFormat(DATE_ATOM, $data['createdAt']);
        $dedicatedHosting->updatedAt = DateTime::createFromFormat(DATE_ATOM, $data['updatedAt']);
    }

    public static function extract(DedicatedHosting $dedicatedHosting): array {
        return [
            'reference' => $dedicatedHosting->reference,
            'owner'     => $dedicatedHosting->owner,

            'subscription'      => $dedicatedHosting->subscription,
            'hostname'          => $dedicatedHosting->hostname,
            'username'          => $dedicatedHosting->username,
            'diskQuotaBytes'    => $dedicatedHosting->diskQuotaBytes,
            'trafficQuotaBytes' => $dedicatedHosting->trafficQuotaBytes,
            'status'            => $dedicatedHosting->status,
            'domainNames'       => $dedicatedHosting->domainNames,
            'ipv4Addresses'     => $dedicatedHosting->ipv4Addresses,
            'maxDomains'        => $dedicatedHosting->maxDomains,

            'createdAt' => $dedicatedHosting->createdAt->format(DATE_ATOM),
            'updatedAt' => $dedicatedHosting->updatedAt->format(DATE_ATOM),
        ];
    }
}
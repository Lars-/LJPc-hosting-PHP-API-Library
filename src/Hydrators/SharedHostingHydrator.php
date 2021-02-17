<?php

namespace LJPcHosting\v1\Hydrators;

use DateTime;
use LJPcHosting\v1\Models\SharedHosting;

class SharedHostingHydrator extends SharedHosting {
    public static function hydrate(array $data, SharedHosting $dedicatedHosting): void {
        $dedicatedHosting->reference = $data['reference'];
        $dedicatedHosting->owner     = $data['owner'];

        $dedicatedHosting->subscription      = $data['subscription'];
        $dedicatedHosting->hostname          = $data['hostname'];
        $dedicatedHosting->username          = $data['username'];
        $dedicatedHosting->diskQuotaBytes    = $data['diskQuotaBytes'];
        $dedicatedHosting->trafficQuotaBytes = $data['trafficQuotaBytes'];
        $dedicatedHosting->status            = $data['status'];
        $dedicatedHosting->domainNames       = $data['domainNames'];

        $dedicatedHosting->createdAt = DateTime::createFromFormat(DATE_ATOM, $data['createdAt']);
        $dedicatedHosting->updatedAt = DateTime::createFromFormat(DATE_ATOM, $data['updatedAt']);
    }

    public static function extract(SharedHosting $dedicatedHosting): array {
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

            'createdAt' => $dedicatedHosting->createdAt->format(DATE_ATOM),
            'updatedAt' => $dedicatedHosting->updatedAt->format(DATE_ATOM),
        ];
    }
}
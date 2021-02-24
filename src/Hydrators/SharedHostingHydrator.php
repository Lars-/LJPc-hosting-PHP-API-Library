<?php

namespace LJPcHosting\v1\Hydrators;

use DateTime;
use LJPcHosting\v1\Models\SharedHosting;

class SharedHostingHydrator extends SharedHosting {
    public static function hydrate(array $data, SharedHosting $sharedHosting): void {
        $sharedHosting->reference = $data['reference'];
        $sharedHosting->owner     = $data['owner'];

        $sharedHosting->subscription      = $data['subscription'];
        $sharedHosting->hostname          = $data['hostname'];
        $sharedHosting->username          = $data['username'];
        $sharedHosting->diskQuotaBytes    = $data['diskQuotaBytes'];
        $sharedHosting->trafficQuotaBytes = $data['trafficQuotaBytes'];
        $sharedHosting->status            = $data['status'];
        $sharedHosting->domainNames       = $data['domainNames'];

        $sharedHosting->createdAt = DateTime::createFromFormat(DATE_ATOM, $data['createdAt']);
        $sharedHosting->updatedAt = DateTime::createFromFormat(DATE_ATOM, $data['updatedAt']);
    }

    public static function extract(SharedHosting $sharedHosting): array {
        return [
            'reference' => $sharedHosting->reference,
            'owner'     => $sharedHosting->owner,

            'subscription'      => $sharedHosting->subscription,
            'hostname'          => $sharedHosting->hostname,
            'username'          => $sharedHosting->username,
            'diskQuotaBytes'    => $sharedHosting->diskQuotaBytes,
            'trafficQuotaBytes' => $sharedHosting->trafficQuotaBytes,
            'status'            => $sharedHosting->status,
            'domainNames'       => $sharedHosting->domainNames,

            'createdAt' => $sharedHosting->createdAt->format(DATE_ATOM),
            'updatedAt' => $sharedHosting->updatedAt->format(DATE_ATOM),
        ];
    }
}
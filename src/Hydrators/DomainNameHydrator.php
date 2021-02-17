<?php

namespace LJPcHosting\v1\Hydrators;

use DateTime;
use LJPcHosting\v1\Models\DomainName;

class DomainNameHydrator extends DomainName {
    public static function hydrate(array $data, DomainName $domainName): void {
        $domainName->reference    = $data['reference'];
        $domainName->owner        = $data['owner'];
        $domainName->subscription = $data['subscription'];

        $domainName->hostname                 = $data['hostname'];
        $domainName->domainOwnerReference     = $data['domainOwnerReference'];
        $domainName->nameserverGroupReference = $data['nameserverGroupReference'];
        $domainName->status                   = $data['status'];
        $domainName->authCode                 = $data['authCode'];

        $domainName->createdAt = DateTime::createFromFormat(DATE_ATOM, $data['createdAt']);
        $domainName->updatedAt = DateTime::createFromFormat(DATE_ATOM, $data['updatedAt']);
    }

    public static function extract(DomainName $domainName): array {
        return [
            'reference'    => $domainName->reference,
            'owner'        => $domainName->owner,
            'subscription' => $domainName->subscription,

            'hostname'                 => $domainName->hostname,
            'domainOwnerReference'     => $domainName->domainOwnerReference,
            'nameserverGroupReference' => $domainName->nameserverGroupReference,
            'status'                   => $domainName->status,
            'authCode'                 => $domainName->authCode,

            'createdAt' => $domainName->createdAt->format(DATE_ATOM),
            'updatedAt' => $domainName->updatedAt->format(DATE_ATOM),
        ];
    }
}
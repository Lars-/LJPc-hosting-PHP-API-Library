<?php

namespace LJPcHosting\v1\Hydrators;

use DateTime;
use LJPcHosting\v1\Models\DomainOwner;

class DomainOwnerHydrator extends DomainOwner {
    public static function hydrate(array $data, DomainOwner $domainOwner): void {
        $domainOwner->reference = $data['reference'];
        $domainOwner->owner     = $data['owner'];

        $domainOwner->companyName  = $data['companyName'];
        $domainOwner->firstName    = $data['firstName'];
        $domainOwner->lastName     = $data['lastName'];
        $domainOwner->phoneNumber  = $data['phoneNumber'];
        $domainOwner->emailAddress = $data['emailAddress'];
        $domainOwner->street       = $data['street'];
        $domainOwner->number       = $data['number'];
        $domainOwner->suffix       = $data['suffix'];
        $domainOwner->zipCode      = $data['zipCode'];
        $domainOwner->city         = $data['city'];
        $domainOwner->country      = $data['country'];

        $domainOwner->createdAt = DateTime::createFromFormat(DATE_ATOM, $data['createdAt']);
        $domainOwner->updatedAt = DateTime::createFromFormat(DATE_ATOM, $data['updatedAt']);
    }

    public static function extract(DomainOwner $domainOwner): array {
        return [
            'reference' => $domainOwner->reference,
            'owner'     => $domainOwner->owner,

            'companyName'  => $domainOwner->companyName,
            'firstName'    => $domainOwner->firstName,
            'lastName'     => $domainOwner->lastName,
            'phoneNumber'  => $domainOwner->phoneNumber,
            'emailAddress' => $domainOwner->emailAddress,
            'street'       => $domainOwner->street,
            'number'       => $domainOwner->number,
            'suffix'       => $domainOwner->suffix,
            'zipCode'      => $domainOwner->zipCode,
            'city'         => $domainOwner->city,
            'country'      => $domainOwner->country,

            'createdAt' => $domainOwner->createdAt->format(DATE_ATOM),
            'updatedAt' => $domainOwner->updatedAt->format(DATE_ATOM),
        ];
    }
}
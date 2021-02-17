<?php

namespace LJPcHosting\v1\Endpoints;

use LJPcHosting\v1\Hydrators\DomainOwnerHydrator;
use LJPcHosting\v1\Models\DomainOwner;

class DomainOwners extends EndpointInterface {
    /**
     * @return DomainOwner[]
     */
    public function all(): array {
        $domainOwners         = $this->call('GET', '/domain_owners');
        $hydratedDomainOwners = [];
        foreach ($domainOwners as $domainName) {
            $newDomainOwner = new DomainOwner();
            DomainOwnerHydrator::hydrate($domainName, $newDomainOwner);
            $hydratedDomainOwners[] = $newDomainOwner;
        }

        return $hydratedDomainOwners;
    }

    public function get(string $reference): DomainOwner {
        $domainOwnerResponse = $this->call('GET', "/domain_owners/$reference");

        $newDomainOwner = new DomainOwner();
        DomainOwnerHydrator::hydrate($domainOwnerResponse, $newDomainOwner);

        return $newDomainOwner;
    }

    public function update(DomainOwner $domainOwner): DomainOwner {
        $domainOwnerData = DomainOwnerHydrator::extract($domainOwner);

        unset($domainOwnerData['reference'], $domainOwnerData['owner'], $domainOwnerData['firstName'], $domainOwnerData['lastName'], $domainOwnerData['createdAt'], $domainOwnerData['updatedAt']);
        $this->call('PUT', '/domain_owners/' . $domainOwner->getReference(), $domainOwnerData);

        return $domainOwner;
    }

    /**
     * @param string $companyName
     * @param string $firstName
     * @param string $lastName
     * @param string $phoneNumber
     * @param string $emailAddress
     * @param string $street
     * @param string $number
     * @param string $suffix
     * @param string $zipCode
     * @param string $city
     * @param string $country
     *
     * @return DomainOwner
     */
    public function create(
        string $companyName,
        string $firstName,
        string $lastName,
        string $phoneNumber,
        string $emailAddress,
        string $street,
        string $number,
        string $suffix,
        string $zipCode,
        string $city,
        string $country
    ): DomainOwner {
        $data           = $this->call('POST', '/domain_owners', [
            'companyName'  => empty($companyName) ? null : $companyName,
            'firstName'    => $firstName,
            'lastName'     => $lastName,
            'phoneNumber'  => $phoneNumber,
            'emailAddress' => $emailAddress,
            'street'       => $street,
            'number'       => $number,
            'suffix'       => empty($suffix) ? null : $suffix,
            'zipCode'      => $zipCode,
            'city'         => $city,
            'country'      => $country,
        ]);
        $newDomainOwner = new DomainOwner();
        DomainOwnerHydrator::hydrate($data, $newDomainOwner);

        return $newDomainOwner;
    }
}
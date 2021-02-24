<?php

namespace LJPcHosting\v1\Endpoints;

use JsonException;
use LJPcHosting\v1\Exceptions\APICallException;
use LJPcHosting\v1\Hydrators\DomainNameHydrator;
use LJPcHosting\v1\Models\DomainName;
use LJPcHosting\v1\Models\DomainOwner;
use LJPcHosting\v1\Models\NameserverGroup;

class DomainNames extends EndpointInterface {
    /**
     * @return DomainName[]
     * @throws JsonException
     * @throws APICallException
     */
    public function all(): array {
        $domainNames         = $this->call('GET', '/domain_names');
        $hydratedDomainNames = [];
        foreach ($domainNames as $domainName) {
            $newDomainName = new DomainName();
            DomainNameHydrator::hydrate($domainName, $newDomainName);
            $hydratedDomainNames[] = $newDomainName;
        }

        return $hydratedDomainNames;
    }

    /**
     * @param string $reference
     *
     * @return DomainName
     * @throws JsonException
     * @throws APICallException
     */
    public function get(string $reference): DomainName {
        $domainNameResponse = $this->call('GET', "/domain_names/$reference");

        $newDomainName = new DomainName();
        DomainNameHydrator::hydrate($domainNameResponse, $newDomainName);

        return $newDomainName;
    }

    /**
     * @param DomainName $domainName
     *
     * @return DomainName
     * @throws JsonException
     * @throws APICallException
     */
    public function update(DomainName $domainName): DomainName {
        $domainNameData = DomainNameHydrator::extract($domainName);

        unset($domainNameData['reference'], $domainNameData['hostname'], $domainNameData['owner'], $domainNameData['subscription'], $domainNameData['status'], $domainNameData['authCode'], $domainNameData['createdAt'], $domainNameData['updatedAt']);
        $this->call('PUT', '/domain_names/' . $domainName->getReference(), $domainNameData);

        return $domainName;
    }

    /**
     * @param string $hostname
     * @param DomainOwner $domainOwner
     * @param NameserverGroup $nameserverGroup
     *
     * @return DomainName
     * @throws JsonException
     * @throws APICallException
     */
    public function create(string $hostname, DomainOwner $domainOwner, NameserverGroup $nameserverGroup): DomainName {
        $data          = $this->call('POST', '/domain_names', [
            'hostname'                 => $hostname,
            'domainOwnerReference'     => $domainOwner->getReference(),
            'nameserverGroupReference' => $nameserverGroup->getReference(),
        ]);
        $newDomainName = new DomainName();
        DomainNameHydrator::hydrate($data, $newDomainName);

        return $newDomainName;
    }

    /**
     * @param string $domainName
     *
     * @return array
     * @throws JsonException
     * @throws APICallException
     */
    public function getStatus(string $domainName): array {
        return $this->call('GET', "/domain_names/status?" . http_build_query(['domain' => $domainName]));
    }

    /**
     * @param array $domainNames
     *
     * @return array
     * @throws JsonException
     * @throws APICallException
     */
    public function getBulkStatus(array $domainNames): array {
        return $this->call('GET',
            "/domain_names/bulk_status?" . http_build_query(['domains' => implode(',', $domainNames)]));
    }
}
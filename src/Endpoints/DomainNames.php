<?php

namespace LJPcHosting\v1\Endpoints;

use LJPcHosting\v1\Hydrators\DomainNameHydrator;
use LJPcHosting\v1\Models\DomainName;
use LJPcHosting\v1\Models\DomainOwner;
use LJPcHosting\v1\Models\NameserverGroup;

class DomainNames extends EndpointInterface {
    /**
     * @return DomainName[]
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

    public function get(string $reference): DomainName {
        $domainNameResponse = $this->call('GET', "/domain_names/$reference");

        $newDomainName = new DomainName();
        DomainNameHydrator::hydrate($domainNameResponse, $newDomainName);

        return $newDomainName;
    }

    public function update(DomainName $domainName): DomainName {
        $domainNameData = DomainNameHydrator::extract($domainName);

        unset($domainNameData['reference'], $domainNameData['hostname'], $domainNameData['owner'], $domainNameData['subscription'], $domainNameData['status'], $domainNameData['authCode'], $domainNameData['createdAt'], $domainNameData['updatedAt']);
        $this->call('PUT', '/domain_names/' . $domainName->getReference(), $domainNameData);

        return $domainName;
    }

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

    public function getStatus(string $domainName): array {
        return $this->call('GET', "/domain_names/status?" . http_build_query(['domain' => $domainName]));
    }

    public function getBulkStatus(array $domainNames): array {
        return $this->call('GET',
            "/domain_names/bulk_status?" . http_build_query(['domains' => implode(',', $domainNames)]));
    }
}
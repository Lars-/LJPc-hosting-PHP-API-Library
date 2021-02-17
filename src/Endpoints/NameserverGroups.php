<?php

namespace LJPcHosting\v1\Endpoints;

use LJPcHosting\v1\Hydrators\NameserverGroupHydrator;
use LJPcHosting\v1\Models\NameserverGroup;
use Nameserver;

class NameserverGroups extends EndpointInterface {
    /**
     * @return NameserverGroup[]
     */
    public function all(): array {
        $nameserverGroups         = $this->call('GET', '/nameserver_groups');
        $hydratedNameserverGroups = [];
        foreach ($nameserverGroups as $nameserverGroup) {
            $newNameserverGroup = new NameserverGroup();
            NameserverGroupHydrator::hydrate($nameserverGroup, $newNameserverGroup);
            $hydratedNameserverGroups[] = $newNameserverGroup;
        }

        return $hydratedNameserverGroups;
    }

    public function get(string $reference): NameserverGroup {
        $nameserverGroupResponse = $this->call('GET', "/nameserver_groups/$reference");

        $newNameserverGroup = new NameserverGroup();
        NameserverGroupHydrator::hydrate($nameserverGroupResponse, $newNameserverGroup);

        return $newNameserverGroup;
    }

    public function update(NameserverGroup $nameserverGroup): NameserverGroup {
        $nameserverGroupData = NameserverGroupHydrator::extract($nameserverGroup);

        unset($nameserverGroupData['reference'], $nameserverGroupData['owner'], $nameserverGroupData['createdAt'], $nameserverGroupData['updatedAt']);
        $this->call('PUT', '/nameserver_groups/' . $nameserverGroup->getReference(), $nameserverGroupData);

        return $nameserverGroup;
    }

    /**
     * @param string $name
     * @param Nameserver[] $nameservers
     *
     * @return NameserverGroup
     */
    public function create(
        string $name,
        array $nameservers
    ): NameserverGroup {
        $data               = $this->call('POST', '/nameserver_groups', [
            'name'        => $name,
            'nameservers' => NameserverGroupHydrator::nameserversToArray($nameservers),
        ]);
        $newNameserverGroup = new NameserverGroup();
        NameserverGroupHydrator::hydrate($data, $newNameserverGroup);

        return $newNameserverGroup;
    }
}
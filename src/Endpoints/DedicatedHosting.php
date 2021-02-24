<?php

namespace LJPcHosting\v1\Endpoints;

use JsonException;
use LJPcHosting\v1\Exceptions\APICallException;
use LJPcHosting\v1\Hydrators\DedicatedHostingHydrator;

class DedicatedHosting extends EndpointInterface {
    /**
     * @return \LJPcHosting\v1\Models\DedicatedHosting[]
     * @throws JsonException
     * @throws APICallException
     */
    public function all(): array {
        $dedicatedHosting    = $this->call('GET', '/dedicated_hosting');
        $hydratedDomainNames = [];
        foreach ($dedicatedHosting as $item) {
            $newHosting = new \LJPcHosting\v1\Models\DedicatedHosting();
            DedicatedHostingHydrator::hydrate($item, $newHosting);
            $hydratedDomainNames[] = $newHosting;
        }

        return $hydratedDomainNames;
    }

    /**
     * @param string $reference
     *
     * @return \LJPcHosting\v1\Models\DedicatedHosting
     * @throws JsonException
     * @throws APICallException
     */
    public function get(string $reference): \LJPcHosting\v1\Models\DedicatedHosting {
        $response = $this->call('GET', "/dedicated_hosting/$reference");

        $newHosting = new \LJPcHosting\v1\Models\DedicatedHosting();
        DedicatedHostingHydrator::hydrate($response, $newHosting);

        return $newHosting;
    }
}
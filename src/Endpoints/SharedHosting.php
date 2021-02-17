<?php

namespace LJPcHosting\v1\Endpoints;

use LJPcHosting\v1\Hydrators\SharedHostingHydrator;

class SharedHosting extends EndpointInterface {
    /**
     * @return \LJPcHosting\v1\Models\SharedHosting[]
     */
    public function all(): array {
        $sharedHosting       = $this->call('GET', '/shared_hosting');
        $hydratedDomainNames = [];
        foreach ($sharedHosting as $item) {
            $newHosting = new \LJPcHosting\v1\Models\SharedHosting();
            SharedHostingHydrator::hydrate($item, $newHosting);
            $hydratedDomainNames[] = $newHosting;
        }

        return $hydratedDomainNames;
    }

    public function get(string $reference): \LJPcHosting\v1\Models\SharedHosting {
        $response = $this->call('GET', "/shared_hosting/$reference");

        $newHosting = new \LJPcHosting\v1\Models\SharedHosting();
        SharedHostingHydrator::hydrate($response, $newHosting);

        return $newHosting;
    }
}
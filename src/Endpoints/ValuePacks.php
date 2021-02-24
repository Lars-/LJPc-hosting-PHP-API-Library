<?php

namespace LJPcHosting\v1\Endpoints;

use JsonException;
use LJPcHosting\v1\Exceptions\APICallException;
use LJPcHosting\v1\Hydrators\ValuePackHydrator;
use LJPcHosting\v1\Models\ValuePack;

class ValuePacks extends EndpointInterface {
    /**
     * @return ValuePack[]
     * @throws JsonException
     * @throws APICallException
     */
    public function all(): array {
        $valuePacks         = $this->call('GET', '/value_packs');
        $hydratedValuePacks = [];
        foreach ($valuePacks as $valuePack) {
            $newValuePack = new ValuePack();
            ValuePackHydrator::hydrate($valuePack, $newValuePack);
            $hydratedValuePacks[] = $newValuePack;
        }

        return $hydratedValuePacks;
    }

    /**
     * @param string $reference
     *
     * @return ValuePack
     * @throws JsonException
     * @throws APICallException
     */
    public function get(string $reference): ValuePack {
        $valuePackResponse = $this->call('GET', "/value_packs/$reference");

        $newValuePack = new ValuePack();
        ValuePackHydrator::hydrate($valuePackResponse, $newValuePack);

        return $newValuePack;
    }
}
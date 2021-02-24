<?php

namespace LJPcHosting\v1\Endpoints;

use JsonException;
use LJPcHosting\v1\API;
use LJPcHosting\v1\Exceptions\APICallException;

class EndpointInterface {
    protected static ?self $instance = null;

    public static function instance() {
        if (self::$instance === null || ! (self::$instance instanceof static)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $data
     *
     * @return array
     * @throws JsonException
     * @throws APICallException
     */
    protected function call(string $method, string $url, array $data = []): array {
        return API::instance()->call($method, $url, $data);
    }
}
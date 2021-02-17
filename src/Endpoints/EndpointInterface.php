<?php

namespace LJPcHosting\v1\Endpoints;

use LJPcHosting\v1\API;

class EndpointInterface {
    protected static ?self $instance = null;

    public static function instance() {
        if (self::$instance === null || ! (self::$instance instanceof static)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    protected function call(string $method, string $url, array $data = []): array {
        return API::instance()->call($method, $url, $data);
    }
}
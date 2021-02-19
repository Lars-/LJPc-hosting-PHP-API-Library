<?php

namespace LJPcHosting\v1\Exceptions;

use Exception;
use Throwable;

class APICallException extends Exception {
    private array $extraInformation;

    public function __construct($message = "", $code = 0, Throwable $previous = null, array $extraInformation = []) {
        $this->extraInformation = $extraInformation;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function getExtraInformation(): array {
        return $this->extraInformation;
    }
}
<?php

namespace App\Exceptions;

use Exception;

class ApiErrorException extends Exception
{
    public function __construct($error, $params = [])
    {
        $error = config('Api.errors.'.$error);

        parent::__construct(vsprintf($error['message'], $params), $error['code']);
    }

    public function toArray()
    {
        return ['code' => $this->getCode(), 'message' => $this->getMessage()];
    }

}

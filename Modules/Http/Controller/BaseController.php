<?php

namespace App\Modules\Http\Controller;

use BadMethodCallException;

abstract class BaseController
{
    public function call($method, $parameters)
    {
        if (method_exists($this, $method)) {
            return $this->{$method}(...array_values($parameters));
        }

        throw new BadMethodCallException(
            "Il metodo $method non esiste in " . get_class($this)
        );
    }
}

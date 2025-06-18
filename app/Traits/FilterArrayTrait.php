<?php

namespace App\Traits;

trait FilterArrayTrait
{
    public function toArrayNotNull() : array
    {
        return array_filter($this->toArray(), function($value) {
            return !is_null($value);
        });
    }

}

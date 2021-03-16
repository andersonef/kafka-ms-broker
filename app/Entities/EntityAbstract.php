<?php

namespace App\Entities;

abstract class EntityAbstract
{
    public function __construct(?array $values)
    {
        if (!$values) {
            return;
        }

        foreach ($values as $property => $value) {
            $this->{$property} = $value;
        }
    }
}

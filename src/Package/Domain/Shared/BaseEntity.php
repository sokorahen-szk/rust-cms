<?php

declare(strict_types=1);

namespace Package\Domain\Shared;

class BaseEntity
{
    public function __construct()
    {
        //
    }

    protected function equal(mixed $class): bool
    {
        return $this instanceof $class;
    }
}

<?php

namespace Package\Domain\User\ValueObject;

class RoleName
{
    public function __construct(private string $value)
    {
        
    }

    public function value(): string
    {
        return $this->value;
    }
}

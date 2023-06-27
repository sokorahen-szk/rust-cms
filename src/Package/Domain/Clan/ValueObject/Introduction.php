<?php

namespace Package\Domain\Clan\ValueObject;

class Introduction
{
    public function __construct(private string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}

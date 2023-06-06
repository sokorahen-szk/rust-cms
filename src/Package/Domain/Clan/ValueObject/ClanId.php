<?php

namespace Package\Domain\Clan\ValueObject;

class ClanId
{
    public function __construct(private string $value)
    {
        if ($value === "") {
            throw new \InvalidArgumentException("clanIDの値が不正です。");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

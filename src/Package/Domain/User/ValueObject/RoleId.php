<?php

namespace Package\Domain\User\ValueObject;

class RoleId
{
    public function __construct(private string $value)
    {
        if ($value === "") {
            throw new \InvalidArgumentException("roleIdの値が不正です。");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

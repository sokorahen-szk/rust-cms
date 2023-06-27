<?php

namespace Package\Domain\User\ValueObject;

class UserId
{
    public function __construct(private string $value)
    {
        if ($value === "") {
            throw new \InvalidArgumentException("userIDの値が不正です。");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

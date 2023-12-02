<?php

namespace Package\Domain\User\ValueObject;

class UserEmailVerifyTokenId
{
    public function __construct(private string $value)
    {
        if ($value === "") {
            throw new \InvalidArgumentException("userEmailVerifyTokenIdの値が不正です。");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

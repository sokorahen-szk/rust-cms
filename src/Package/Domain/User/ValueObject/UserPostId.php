<?php

namespace Package\Domain\User\ValueObject;

class UserPostId
{
    public function __construct(private string $value)
    {
        if ($value === "") {
            throw new \InvalidArgumentException(get_class() . "の値が不正です。");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

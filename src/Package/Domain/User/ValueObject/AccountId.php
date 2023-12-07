<?php

namespace Package\Domain\User\ValueObject;

class AccountId
{
    public function __construct(private string $value)
    {
        if (!preg_match("/^[a-zA-Z]$/", $value[0])) {
            throw new \InvalidArgumentException(get_class() . "は、最初の文字はa-z/A-Zのみ使用可能です。");
        }
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $value)) {
            throw new \InvalidArgumentException(get_class() . "は、a-z/A-Z/0-9のみ使用可能です");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

<?php

namespace Package\Domain\Clan\ValueObject;

class ClanName
{
    public function __construct(private string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException("clan名が正しく設定されていません。");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

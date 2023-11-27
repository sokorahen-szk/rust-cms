<?php

namespace Package\Domain\Player\ValueObject;

class PlayerName
{
    public function __construct(private string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException("player名が正しく設定されていません。");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

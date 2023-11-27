<?php

namespace Package\Domain\Player\ValueObject;

class PlayerId
{
    public function __construct(private string $value)
    {
        if ($value === "") {
            throw new \InvalidArgumentException("playerIdの値が不正です。");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

<?php

namespace Package\Domain\Tag\ValueObject;

class TagId
{
    public function __construct(private string $value)
    {
        if ($value === "") {
            throw new \InvalidArgumentException("tagIdの値が不正です。");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

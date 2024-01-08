<?php declare(strict_types=1);

namespace Package\Domain\Clan\ValueObject;

class Introduction
{
    public function __construct(private string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}

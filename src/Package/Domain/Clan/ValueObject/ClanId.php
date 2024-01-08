<?php declare(strict_types=1);

namespace Package\Domain\Clan\ValueObject;

class ClanId
{
    public function __construct(private string $value)
    {
        if ($value === "") {
            throw new \InvalidArgumentException("clanIDの値が不正です。");
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equal(ClanId $class): bool
    {
        return $this instanceof $class && $this->value() === $class->value();
    }
}

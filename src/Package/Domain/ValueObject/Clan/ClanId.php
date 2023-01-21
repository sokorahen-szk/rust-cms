<?php namespace Package\Domain\ValueObject\Clan;

class ClanId {
    public function __construct(private int $value)
    {
        if ($value === 0) {
            throw new \InvalidArgumentException("clanIDの値が不正です。");
        }
    }

    public function value(): int
    {
        return $this->value;
    }
}
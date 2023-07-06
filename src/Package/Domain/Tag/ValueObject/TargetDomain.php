<?php

declare(strict_types=1);

namespace Package\Domain\Tag\ValueObject;

class TargetDomain
{
    public const LIMIT_BIT = 2;

    public function __construct(private int $value)
    {
        $n = $value;
        for ($i = 1; ;$i++) {
            $n = $n >> 1;

            if ($n > 1) {
                continue;
            }

            if ($n == 0 && $i <= self::LIMIT_BIT) {
                break;
            }

            throw new \Exception("invalid target domain number error");
        }
    }

    public function isTarget(int $checkBit): bool
    {
        return (bool) ($checkBit & $this->value);
    }
}

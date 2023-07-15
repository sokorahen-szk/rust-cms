<?php

declare(strict_types=1);

namespace Package\Domain\Tag\ValueObject;

class TargetDomain
{
    // ビット長
    public const LIMIT_BIT_LENGTH = 2;

    public function __construct(private int $value)
    {
        if (!$this->validBitLength($value)) {
            throw new \Exception("invalid target domain number error");
        }
    }

    public function isTarget(int $checkBit): bool
    {
        return (bool) ($checkBit & $this->value);
    }

    private function validBitLength(int $value): bool
    {
        $n = $value;
        for ($i = 1; ;$i++) {
            $n = $n >> 1;

            if ($n == 0 && $i <= self::LIMIT_BIT_LENGTH) {
                return true;
            }
        }

        return false;
    }
}

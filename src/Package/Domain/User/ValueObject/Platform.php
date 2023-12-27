<?php

namespace Package\Domain\User\ValueObject;

class Platform
{
    const PLATFORM_PC = "PC";
    const PLATFORM_PS4 = "PS4";
    const PLATFORM_XBOX = "Xbox";
    public function __construct(private string $value)
    {
        $platforms = [
            self::PLATFORM_PC,
            self::PLATFORM_PS4,
            self::PLATFORM_XBOX,
        ];

        if (!in_array($value, $platforms)) {
            throw new \Exception("unknown platform value error");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

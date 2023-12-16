<?php

namespace Package\Domain\User\ValueObject;

class Platform
{
    const PlatformPC = "PC";
    const PlatformPS4 = "PS4";
    const PlatformXbox = "Xbox";
    public function __construct(private string $value)
    {
        $platforms = [
            self::PlatformPC,
            self::PlatformPS4,
            self::PlatformXbox,
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

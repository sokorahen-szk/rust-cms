<?php

namespace Package\Domain\User\ValueObject;

class AvatarImage
{
    public const AVATAR_DEFAULT_IMAGE = "https://placehold.jp/150x150.png";

    public function __construct(private string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }


}

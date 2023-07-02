<?php

namespace Package\Domain\User\ValueObject;

use Illuminate\Support\Facades\Hash;

class Password
{
    public function __construct(
        private string $value,
        private bool $isHashed = false
    ) {
    }

    public function hashedText(): string
    {
        if (!$this->isHashed) {
            throw new \Exception("value isn't hashed");
        }

        return $this->value;
    }

    public function plainText(): string
    {
        if ($this->isHashed) {
            throw new \Exception("this value is hashed");
        }
        return $this->value;
    }

    public function hash(): Password
    {
        if ($this->isHashed) {
            throw new \Exception("this value is already hashed");
        }
        return new Password(Hash::make($this->value), true);
    }
}

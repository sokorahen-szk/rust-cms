<?php

namespace Package\Domain\User\ValueObject;

class UserStatus
{
    // アカウント作成途中で中断した場合
    public const WAITING = "WAITING";

    // アカウント無効
    public const INACTIVE = "INACTIVE";

    // アカウント有効
    public const ACTIVE = "ACTIVE";

    // アカウント退会済み
    public const WITHDRAWN = "WITHDRAWN";

    // アカウント停止
    public const BANNED = "BANNED";

    public function __construct(private string $value)
    {
        $statuses = [
            self::WAITING,
            self::INACTIVE,
            self::ACTIVE,
            self::WITHDRAWN,
            self::BANNED,
        ];

        if (!in_array($value, $statuses)) {
            throw new \Exception("unknown status value error");
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function isActive(): bool
    {
        return self::ACTIVE === $this->value;
    }
}

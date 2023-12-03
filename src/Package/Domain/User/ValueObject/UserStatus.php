<?php

namespace Package\Domain\User\ValueObject;
use App\Exceptions\ValueObjectInvalidException;

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

    // 運用上、特殊な用件で使用する場合にロックする
    public const SPECIAL_REQUIREMENT_LOCK = "SPECIAL_REQUIREMENT_LOCK";

    // アカウント停止
    public const BANNED = "BANNED";

    public function __construct(private string $value)
    {
        $statuses = [
            self::WAITING,
            self::INACTIVE,
            self::ACTIVE,
            self::WITHDRAWN,
            self::SPECIAL_REQUIREMENT_LOCK,
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

    public function changeActive(): UserStatus
    {
        if ($this->value === self::WAITING || self::INACTIVE) {
            return new UserStatus(self::ACTIVE);
        }

        throw new ValueObjectInvalidException("user status は、WAITING, INACTIVEのみ、ACTIVEに変更可能");
    }
}

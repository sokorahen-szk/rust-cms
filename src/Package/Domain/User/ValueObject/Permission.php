<?php

namespace Package\Domain\User\ValueObject;

class Permission
{
    // メンバー
    public const MEMBER = "MEMBER";

    // オペレーター
    public const OPERATOR = "OPERATOR";

    // 管理者
    public const ADMINISTRATOR = "ADMINISTRATOR";

    public function __construct(private string $value)
    {
        $permissions = [
            self::MEMBER,
            self::OPERATOR,
            self::ADMINISTRATOR,
        ];

        if (!in_array($value, $permissions)) {
            throw new \Exception("unknown permission value error");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

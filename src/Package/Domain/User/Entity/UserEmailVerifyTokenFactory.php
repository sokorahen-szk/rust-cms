<?php

declare(strict_types=1);

namespace Package\Domain\User\Entity;

use Illuminate\Support\Str;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\ValueObject\UserEmailVerifyTokenId;
use Package\Domain\User\ValueObject\UserId;

class UserEmailVerifyTokenFactory
{
    const EMAIL_VERIFY_EXPIRES_MINUTES = 30;

    public function __construct(
        private string $userId
    ) {
    }

    public function make(): UserEmailVerifyToken
    {
        $id = (string) Str::uuid();
        $now = now();
        return new UserEmailVerifyToken(
            new UserEmailVerifyTokenId($id),
            new UserId($this->userId),
            false,
            new Datetime($now->addMinutes(self::EMAIL_VERIFY_EXPIRES_MINUTES))
        );
    }
}

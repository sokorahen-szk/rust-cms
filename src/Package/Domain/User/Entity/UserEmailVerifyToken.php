<?php

declare(strict_types=1);

namespace Package\Domain\User\Entity;

use Package\Domain\Shared\BaseEntity as Entity;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\ValueObject\UserEmailVerifyTokenId;
use Package\Domain\User\ValueObject\UserId;

class UserEmailVerifyToken extends Entity
{
    public function __construct(
        private UserEmailVerifyTokenId $id,
        private UserId $userId,
        private bool $verified,
        private Datetime $expiresAt
    )
    {
        
    }

    public function id(): UserEmailVerifyTokenId
    {
        return $this->id;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function verified(): bool
    {
        return $this->verified;
    }

    public function expiresAt(): Datetime
    {
        return $this->expiresAt;
    }
}

<?php

declare(strict_types=1);

namespace Package\Domain\User\Entity;

use Package\Domain\Shared\BaseEntity as Entity;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\ValueObject\AccountId;
use Package\Domain\User\ValueObject\Email;
use Package\Domain\User\ValueObject\Password;
use Package\Domain\User\ValueObject\RoleId;
use Package\Domain\User\ValueObject\UserId;
use Package\Domain\User\ValueObject\UserStatus;

class User extends Entity
{
    public function __construct(
        private UserId $id,
        private AccountId $accountId,
        private string $name,
        private UserStatus $status,
        private RoleId $roleId,
        private Email $email,
        private ?Datetime $emailVeifiedAt,
        private string $discordId,
        private string $twitterId,
        private string $steamId,
        private Password $password,
        private string $description,
        private ?UserId $createUserId,
        private Datetime $createdAt,
        private Datetime $updatedAt
    ) {
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function accountId(): AccountId
    {
        return $this->accountId;
    }
    
    public function name(): string
    {
        return $this->name;
    }

    public function status(): UserStatus
    {
        return $this->status;
    }

    public function roleId(): RoleId
    {
        return $this->roleId;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function emailVeifiedAt(): Datetime
    {
        return $this->emailVeifiedAt;
    }

    public function discordId(): string
    {
        return $this->discordId;
    }

    public function twitterId(): string
    {
        return $this->twitterId;
    }

    public function steamId(): string
    {
        return $this->steamId;
    }

    public function password(): Password
    {
        return $this->password;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function createUserId(): ?UserId
    {
        return $this->createUserId;
    }

    public function createdAt(): Datetime
    {
        return $this->createdAt;
    }

    public function updatedAt(): Datetime
    {
        return $this->updatedAt;
    }
}

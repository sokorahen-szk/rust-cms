<?php

declare(strict_types=1);

namespace Package\Domain\User\Entity;

use Package\Domain\Shared\BaseEntity as Entity;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\ValueObject\Email;
use Package\Domain\User\ValueObject\Password;
use Package\Domain\User\ValueObject\RoleId;
use Package\Domain\User\ValueObject\UserId;
use Package\Domain\User\ValueObject\UserStatus;

class User extends Entity
{
    public function __construct(
        private UserId $id,
        private string $name,
        private RoleId $roleId,
        private UserStatus $status,
        private Email $email,
        private Datetime $emailVeifiedAt,
        private Password $password,
        private string $description,
        private Datetime $createdAt,
        private Datetime $updatedAt,
        private ?UserId $createUserId
    ) {
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function roleId(): RoleId
    {
        return $this->roleId;
    }

    public function status(): UserStatus
    {
        return $this->status;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function emailVeifiedAt(): Datetime
    {
        return $this->emailVeifiedAt;
    }

    public function password(): Password
    {
        return $this->password;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function createdAt(): Datetime
    {
        return $this->createdAt;
    }

    public function updatedAt(): Datetime
    {
        return $this->updatedAt;
    }

    public function createUserId(): ?UserId
    {
        return $this->createUserId;
    }
}

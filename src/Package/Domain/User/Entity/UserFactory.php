<?php

declare(strict_types=1);

namespace Package\Domain\User\Entity;

use Illuminate\Support\Str;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\Entity\User;
use Package\Domain\User\ValueObject\AccountId;
use Package\Domain\User\ValueObject\Email;
use Package\Domain\User\ValueObject\Password;
use Package\Domain\User\ValueObject\RoleId;
use Package\Domain\User\ValueObject\UserId;
use Package\Domain\User\ValueObject\UserStatus;

class UserFactory
{
    public function __construct(
        private string $accountId,
        private string $name,
        private string $roleId,
        private ?string $email,
        private ?string $discordId,
        private ?string $twitterId,
        private ?string $steamId,
        private string $password,
        private ?string $description,
        private ?string $createdUserId,
    ) {
    }

    /**
     * @return User
     */
    public function makeGeneralUser(): User
    {
        $id = (string) Str::uuid();
        $now = now();
        $password = new Password($this->password);
        $hashedPassword = $password->hash();
        return new User(
            new UserId($id),
            new AccountId($this->accountId),
            $this->name,
            new UserStatus(UserStatus::ACTIVE),
            new RoleId($this->roleId),
            $this->email ? new Email($this->email) : null,
            null,
            $this->discordId ?: $this->discordId,
            $this->twitterId ?: $this->twitterId,
            $this->steamId ?: $this->steamId,
            $hashedPassword,
            $this->description ?: $this->description,
            $this->createdUserId ? new UserId($this->createdUserId) : null,
            new Datetime($now),
            new Datetime($now)
        );
    }
}

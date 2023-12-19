<?php

declare(strict_types=1);

namespace Package\Domain\User\Entity;
use Package\Domain\Shared\BaseEntity as Entity;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\ValueObject\Platform;
use Package\Domain\User\ValueObject\UserId;
use Package\Domain\User\ValueObject\UserPostId;

class UserPost extends Entity
{
    public User $user;
    public function __construct(
        private UserPostId $id,
        private Platform $platform,
        private string $message,
        private bool $isDisplayLoggedInUser,
        private UserId $createdUserId,
        private ?Datetime $closeAt,
        private Datetime $createdAt
    )
    {
    }

    public function id(): UserPostId
    {
        return $this->id;
    }

    public function platform(): Platform
    {
        return $this->platform;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function isDisplayLoggedInUser(): bool
    {
        return $this->isDisplayLoggedInUser;
    }

    public function createdUserId(): UserId
    {
        return $this->createdUserId;
    }

    public function closeAt(): ?Datetime
    {
        return $this->closeAt;
    }

    public function createdAt(): Datetime
    {
        return $this->createdAt;
    }

    public function setUser(User $user): void
    {
        if ($this->createdUserId()->equal($user->id())) {
            $this->user = $user;
        }
    }

    public function getUser(): User
    {
        return $this->user;
    }
}

<?php

declare(strict_types=1);

namespace Package\Domain\User\Repository;

use Package\Domain\User\Entity\User;
use Package\Domain\User\ValueObject\UserId;
use Package\Infrastructure\User\Input\ListUserInput;

interface IUserRepository
{
    /**
     * @param UserId $id
     * @return User
     */
    public function get(UserId $id): User;
    /**
     * @param ListUserInput $input
     * @return User[]
     */
    public function list(ListUserInput $input): array;
    /**
     * @param User $user
     * @return User
     */
    public function create(User $user): User;

    /**
     * @param User $user
     */
    public function update(User $user): void;
}

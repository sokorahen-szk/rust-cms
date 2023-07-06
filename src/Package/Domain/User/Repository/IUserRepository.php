<?php

declare(strict_types=1);

namespace Package\Domain\Clan\Repository;

use Package\Domain\User\Entity\User;
use Package\Domain\User\ValueObject\UserId;
use Package\Infrastructure\Input\ListUserInput;

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
}

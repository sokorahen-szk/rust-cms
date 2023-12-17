<?php

declare(strict_types=1);

namespace Package\Domain\User\Repository;

use Package\Domain\User\Entity\UserPost;
use Package\Infrastructure\User\Input\ListUserPostInput;

interface IUserPostRepository
{
    /**
     * @param ListUserPostInput $input
     * @return UserPost[]
     */
    public function list(ListUserPostInput $input): array;
}

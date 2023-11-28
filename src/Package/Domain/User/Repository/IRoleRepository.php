<?php

declare(strict_types=1);

namespace Package\Domain\User\Repository;

use Package\Domain\User\Entity\Role;
use Package\Infrastructure\Role\Input\ListRoleInput;

interface IRoleRepository
{
    /**
     * @param ListRoleInput $input
     * @return Role[]
     */
    public function list(ListRoleInput $input): array;
}

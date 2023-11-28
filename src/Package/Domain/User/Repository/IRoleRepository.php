<?php

declare(strict_types=1);

namespace Package\Domain\User\Repository;

use Package\Domain\User\Entity\Role;

interface IRoleRepository
{
    /**
     * @param Role $role
     * @return Role
     */
    public function create(Role $role): Role;
}

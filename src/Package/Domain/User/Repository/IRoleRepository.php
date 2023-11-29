<?php

declare(strict_types=1);

namespace Package\Domain\User\Repository;

use Package\Domain\User\Entity\Role;
use Package\Domain\User\ValueObject\Permission;

interface IRoleRepository
{
    /**
     * @param Permission $permission
     * @return Role
     */
    public function getByDefaultPermission(Permission $permission): Role;
}

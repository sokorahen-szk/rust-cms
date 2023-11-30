<?php

declare(strict_types=1);

namespace Package\Domain\User\Entity;

use Package\Domain\Shared\BaseEntity as Entity;
use Package\Domain\User\ValueObject\DefaultPermission;
use Package\Domain\User\ValueObject\RoleId;
use Package\Domain\User\ValueObject\Permission;
use Package\Domain\User\ValueObject\PermissionLevel;
use Package\Domain\User\ValueObject\RoleName;

class Role extends Entity
{
    public function __construct(
        private RoleId $id,
        private RoleName $name,
        private Permission $permission,
        private PermissionLevel $permissionLevel,
        private ?DefaultPermission $defaultPermission,
        private ?string $description
    ) {
    }

    public function id(): RoleId
    {
        return $this->id;
    }

    public function name(): RoleName
    {
        return $this->name;
    }

    public function permission(): Permission
    {
        return $this->permission;
    }

    public function permissionLevel(): PermissionLevel
    {
        return $this->permissionLevel;
    }

    public function defaultPermission(): ?DefaultPermission
    {
        return $this->defaultPermission;
    }

    public function description(): ?string
    {
        return $this->description;
    }
}

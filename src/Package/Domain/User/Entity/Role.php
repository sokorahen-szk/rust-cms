<?php

declare(strict_types=1);

namespace Package\Domain\User\Entity;

use Package\Domain\Shared\BaseEntity as Entity;
use Package\Domain\User\ValueObject\RoleId;
use Package\Domain\User\ValueObject\Permission;

class Role extends Entity
{
    public function __construct(
        private RoleId $id,
        private Permission $permission,
        private string $description
    ) {
    }

    public function id(): RoleId
    {
        return $this->id;
    }

    public function permission(): Permission
    {
        return $this->permission;
    }

    public function description(): string
    {
        return $this->description;
    }
}

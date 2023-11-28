<?php

declare(strict_types=1);

namespace Package\Infrastructure\Role\Input;
use Package\Domain\User\ValueObject\Permission;

class ListRoleInput
{
    /**
     * @param Permission[] $permissions
     */
    public function __construct(public array $permissions = [])
    {
    }
}

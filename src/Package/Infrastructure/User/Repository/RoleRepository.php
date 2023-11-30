<?php

declare(strict_types=1);

namespace Package\Infrastructure\User\Repository;

use Package\Domain\User\Repository\IRoleRepository;
use App\Models\RoleModel;
use App\Exceptions\NotFoundRecordException;
use Package\Domain\User\ValueObject\Permission;
use Package\Domain\User\Entity\Role;
use Package\Domain\User\ValueObject\DefaultPermission;
use Package\Domain\User\ValueObject\PermissionLevel;
use Package\Domain\User\ValueObject\RoleId;
use Package\Domain\User\ValueObject\RoleName;

class RoleRepository implements IRoleRepository {
    /**
     * @param RoleModel $roleModel
     */
    public function __construct(private RoleModel $roleModel)
    {
    }

    /**
     * @inheritDoc
     */
    public function getByDefaultPermission(Permission $permission): Role
    {
        $model = $this->roleModel
            ->where("permission",  $permission->value())
            ->where("default_permission", DefaultPermission::DEFAULT_PERMISSION_KEY)
            ->first();

        if (is_null($model)) {
            throw new NotFoundRecordException("no role record");
        }
        return $this->toRole($model);
    }

    /**
     * @param RoleModel $roleModel
     * @return Role
     */
    private function toRole(RoleModel $roleModel): Role
    {
        return new Role(
            new RoleId($roleModel->id),
            new RoleName($roleModel->name),
            new Permission($roleModel->permission),
            new PermissionLevel($roleModel->permission_level),
            new DefaultPermission($roleModel->default_permission),
            $roleModel->description
        );
    }
}
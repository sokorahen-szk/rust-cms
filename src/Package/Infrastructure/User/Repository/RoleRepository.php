<?php

declare(strict_types=1);

namespace Package\Infrastructure\User\Repository;

use Package\Domain\User\Repository\IRoleRepository;
use App\Models\RoleModel;
use App\Exceptions\NotFoundRecordException;
use Package\Domain\Shared\Infrastructure\ModelToEntityConverter;
use Package\Domain\User\ValueObject\Permission;
use Package\Domain\User\Entity\Role;
use Package\Domain\User\ValueObject\DefaultPermission;

class RoleRepository implements IRoleRepository
{
    use ModelToEntityConverter;

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
}
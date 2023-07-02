<?php

namespace Tests\Unit\Package\Domain\User\Entity;

use Package\Domain\User\Entity\Role;
use Package\Domain\User\ValueObject\Permission;
use Package\Domain\User\ValueObject\RoleId;

test("正常な引数をコンストラクタに渡した場合、エラーにならないこと", function () {
    $role = new Role(
        new RoleId("3b93960f-6744-40f1-8662-c8740f64d218"),
        new Permission("1200"),
        "role description"
    );

    $this->assertEquals("3b93960f-6744-40f1-8662-c8740f64d218", $role->id()->value());
    $this->assertEquals("role description", $role->description());
});

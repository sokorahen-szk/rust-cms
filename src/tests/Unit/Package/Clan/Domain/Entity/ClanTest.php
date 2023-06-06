<?php

namespace Tests\Unit\Package\Domain\Clan\Entity;

use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Clan\ValueObject\ClanName;
use Package\Domain\Clan\Entity\Clan;

test("正常な引数をコンストラクタに渡した場合、エラーにならないこと", function () {
    $clan = new Clan(
        new ClanId("CA9E2714-CA0C-44BD-9E9D-6D072FF9281B"),
        new ClanName("クラン名"),
        new Datetime("2023-01-01 00:00:00"),
        new Datetime("2023-01-01 23:59:59")
    );

    $this->assertEquals("CA9E2714-CA0C-44BD-9E9D-6D072FF9281B", $clan->id()->value());
    $this->assertEquals("クラン名", $clan->name()->value());
    $this->assertEquals("2023-01-01 00:00:00", $clan->createdAt()->toDatetimeString());
    $this->assertEquals("2023-01-01 23:59:59", $clan->updatedAt()->toDatetimeString());
});

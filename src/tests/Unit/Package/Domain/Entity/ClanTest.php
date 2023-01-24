<?php namespace Tests\Unit\Package\Domain\Entity;

use Package\Domain\ValueObject\Datetime;
use Package\Domain\ValueObject\Clan\ClanId;
use Package\Domain\ValueObject\Clan\ClanName;
use Package\Domain\Entity\Clan;

test("正常な引数をコンストラクタに渡した場合、エラーにならないこと", function() {
    $clan = new Clan(
        new ClanId(1),
        new ClanName("クラン名"),
        new Datetime("2023-01-01 00:00:00"),
        new Datetime("2023-01-01 23:59:59")
    );

    $this->assertEquals(1, $clan->id()->value());
    $this->assertEquals("クラン名", $clan->name()->value());
    $this->assertEquals("2023-01-01 00:00:00", $clan->createdAt()->toDatetimeString());
    $this->assertEquals("2023-01-01 23:59:59", $clan->updatedAt()->toDatetimeString());
});

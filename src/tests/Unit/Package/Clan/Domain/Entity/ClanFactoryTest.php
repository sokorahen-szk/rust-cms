<?php

use Package\Domain\Clan\Entity\ClanFactory;
use Illuminate\Support\Str;
use Package\Domain\Shared\ValueObject\Datetime;

test("正常な引数をコンストラクタに渡した場合、エラーにならないこと", function () {
    $factory = new ClanFactory("clan_name");
    $actualClan = $factory->make();
    $this->assertEquals("clan_name", $actualClan->name()->value());
    $this->assertTrue(Str::isUuid($actualClan->id()->value()));
    $this->assertTrue($actualClan->createdAt() instanceof Datetime);
    $this->assertTrue($actualClan->updatedAt() instanceof Datetime);
});

<?php

use Package\Domain\Clan\Entity\ClanFactory;
use Illuminate\Support\Str;
use Package\Domain\Shared\ValueObject\Datetime;

test("正常な引数をコンストラクタに渡した場合、エラーにならないこと", function () {
    $factory = new ClanFactory("clan_name", "hugahuga.jpg", "aiueo", 1);
    $actualClan = $factory->make();
    $this->assertTrue(Str::isUuid($actualClan->id()->value()));
    $this->assertEquals("clan_name", $actualClan->name()->value());
    $this->assertEquals("hugahuga.jpg", $actualClan->imageUrl()->value());
    $this->assertEquals("aiueo", $actualClan->introduction()->value());
    $this->assertEquals(1, $actualClan->createdUserId()->value());
    $this->assertTrue($actualClan->createdAt() instanceof Datetime);
    $this->assertTrue($actualClan->updatedAt() instanceof Datetime);
});

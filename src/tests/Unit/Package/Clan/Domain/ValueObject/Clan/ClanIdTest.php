<?php

namespace Tests\Unit\Package\Domain\Clan\ValueObject\Clan;

use Package\Domain\Clan\ValueObject\ClanId;

test("正常な値をコンストラクタに渡した場合、エラーにならないこと", function () {
    $clanId = new ClanId("CA9E2714-CA0C-44BD-9E9D-6D072FF9281B");
    $this->assertEquals("CA9E2714-CA0C-44BD-9E9D-6D072FF9281B", $clanId->value());
});

test("不正な値をコンストラクタに渡した場合、エラーになること", function () {
    new ClanId("");
})->throws(\InvalidArgumentException::class);

<?php

namespace Tests\Unit\Package\Domain\Clan\ValueObject\Clan;

use Package\Domain\Clan\ValueObject\ClanId;

test("正常な値をコンストラクタに渡した場合、エラーにならないこと", function () {
    $clanId = new ClanId(1);
    $this->assertEquals(1, $clanId->value());
});

test("不正な値をコンストラクタに渡した場合、エラーになること", function () {
    new ClanId(0);
})->throws(\InvalidArgumentException::class);

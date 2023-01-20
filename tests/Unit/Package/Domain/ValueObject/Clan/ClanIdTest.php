<?php namespace Tests\Unit\Package\Domain\ValueObject\Clan;

use Package\Domain\ValueObject\Clan\ClanId;

it("正常な値をコンストラクタに渡した場合、エラーにならないこと", function() {
    $clanId = new ClanId(1);
    $this->assertEquals(1, $clanId->value());
});

it("不正な値をコンストラクタに渡した場合、エラーになること", function() {
    new ClanId(0);
})->throws(\InvalidArgumentException::class);

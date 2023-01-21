<?php namespace Tests\Unit\Package\Domain\ValueObject\Clan;

use Package\Domain\ValueObject\Clan\ClanName;

it("正常な値をコンストラクタに渡した場合、エラーにならないこと", function() {
    $clanName = new ClanName("クラン名");
    $this->assertEquals("クラン名", $clanName->value());
});

it("空文字をコンストラクタに渡した場合、エラーになること", function() {
    new ClanName("");
})->throws(\InvalidArgumentException::class);

<?php namespace Tests\Unit\Package\Domain\Entity;

use Package\Domain\Entity\Clan;
use Carbon\Carbon;

it("正常な引数をコンストラクタに渡した場合、エラーにならないこと", function() {
    $clan = new Clan([
        "id" => 1,
        "name" => "クラン名",
        "createdAt" => new Carbon("2023-01-01 00:00:00"),
        "updatedAt" => new Carbon("2023-01-01 23:59:59"),
    ]);

    $this->assertEquals(1, $clan->id());
    $this->assertEquals("クラン名", $clan->name());
    $this->assertEquals("2023-01-01 00:00:00", $clan->createdAt()->toDatetimeString());
    $this->assertEquals("2023-01-01 23:59:59", $clan->updatedAt()->toDatetimeString());
});

it("コンストラクタ引数に、メンバー変数に存在しない変数を指定した場合", function() {
    new Clan([
        "fuga" => 1,
        "name" => "クラン名",
        "createdAt" => new Carbon("2023-01-01 00:00:00"),
        "updatedAt" => new Carbon("2023-01-01 23:59:59"),
    ]);
})->throws(\DomainException::class);
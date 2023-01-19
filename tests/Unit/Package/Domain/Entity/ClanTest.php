<?php namespace Tests\Unit\Package\Domain\Entity;

use Package\Domain\ValueObject\Datetime;
use Package\Domain\Entity\Clan;

it("正常な引数をコンストラクタに渡した場合、エラーにならないこと", function() {
    $clan = new Clan(
        1,
        "クラン名",
        new Datetime("2023-01-01 00:00:00"),
        new Datetime("2023-01-01 23:59:59")
    );

    $this->assertEquals(1, $clan->id());
    $this->assertEquals("クラン名", $clan->name());
    $this->assertEquals("2023-01-01 00:00:00", $clan->createdAt()->toDatetimeString());
    $this->assertEquals("2023-01-01 23:59:59", $clan->updatedAt()->toDatetimeString());
});

it("idが正しくない場合、エラーになること", function() {
    new Clan(
        0,
        "クラン名",
        new Datetime("2023-01-01 00:00:00"),
        new Datetime("2023-01-01 23:59:59")
    );
})->throws(\InvalidArgumentException::class);


it("nameが正しくない場合、エラーになること", function() {
    new Clan(
        1,
        "",
        new Datetime("2023-01-01 00:00:00"),
        new Datetime("2023-01-01 23:59:59")
    );
})->throws(\InvalidArgumentException::class);
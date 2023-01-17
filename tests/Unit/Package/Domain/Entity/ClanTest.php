<?php namespace Tests\Unit\Package\Domain\Entity;

use Package\Domain\Entity\Clan;

test("正常な引数をコンストラクタに渡した場合、エラーにならないこと", function() {
    $clan = new Clan([
        "id" => 1,
        "name" => "クラン名"
    ]);

    $this->assertEquals(1, $clan->id);
    $this->assertEquals("クラン名", $clan->name);
    // TODO:
});
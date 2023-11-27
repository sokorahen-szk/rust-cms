<?php

namespace Tests\Unit\Package\Infrastructure\Clan\Input;

use Package\Infrastructure\Clan\Input\ListClanInput;

test("idsが設定できること", function () {
    $input = new ListClanInput([1, 2, 3]);
    $this->assertSame([1, 2, 3], $input->ids);
});

<?php namespace Tests\Unit\Package\Infrastructure\Input;

use Package\Infrastructure\Input\ListClanInput;

test("idsが設定できること", function() {
    $input = new ListClanInput([1, 2, 3]);
    $this->assertSame([1, 2, 3], $input->ids);
});
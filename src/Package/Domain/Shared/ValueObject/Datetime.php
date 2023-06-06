<?php

namespace Package\Domain\Shared\ValueObject;

use Carbon\Carbon;

class Datetime extends Carbon
{
    public function __construct($time = null, $tz = null)
    {
        return parent::__construct($time, $tz);
    }
}

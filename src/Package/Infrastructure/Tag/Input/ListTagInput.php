<?php

declare(strict_types=1);

namespace Package\Infrastructure\Tag\Input;

class ListTagInput
{
    public function __construct(public ?bool $isEnabled, public ?bool $isDisplayOnTop)
    {
    }
}

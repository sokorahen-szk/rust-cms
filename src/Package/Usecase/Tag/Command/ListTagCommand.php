<?php

declare(strict_types=1);

namespace Package\Usecase\Tag\Command;

class ListTagCommand
{
    public function __construct(public ?bool $isDisplayOnTop) {
    }
}

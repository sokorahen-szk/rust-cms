<?php

declare(strict_types=1);

namespace Package\Infrastructure\User\Input;

class ListUserInput
{
    public function __construct(public ?string $keywords)
    {
    }
}

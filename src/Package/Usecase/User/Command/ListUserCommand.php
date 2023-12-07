<?php

declare(strict_types=1);

namespace Package\Usecase\User\Command;

class ListUserCommand
{
    public function __construct(
        public ?string $keywords,
    )
    {
    }
}

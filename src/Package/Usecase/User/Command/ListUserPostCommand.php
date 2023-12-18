<?php

declare(strict_types=1);

namespace Package\Usecase\User\Command;

class ListUserPostCommand
{
    public function __construct(
        public bool $isLogin,
        public ?array $platforms,
        public ?string $sortKey
    )
    {
    }
}

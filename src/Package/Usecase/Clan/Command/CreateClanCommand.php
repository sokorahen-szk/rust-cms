<?php

declare(strict_types=1);

namespace Package\Usecase\Clan\Command;

class CreateClanCommand
{
    public function __construct(
        public string $name,
        public string $imageUrl,
        public string $introduction
    )
    {
    }
}

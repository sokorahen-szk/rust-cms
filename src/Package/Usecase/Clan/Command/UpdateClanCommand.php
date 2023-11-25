<?php

declare(strict_types=1);

namespace Package\Usecase\Clan\Command;

class UpdateClanCommand
{
    public function __construct(
        public string $id,
        public string $name,
        public string $imageUrl,
        public string $introduction
    )
    {
    }
}

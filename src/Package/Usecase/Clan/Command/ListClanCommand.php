<?php

declare(strict_types=1);

namespace Package\Usecase\Clan\Command;

class ListClanCommand
{
    public function __construct(
        public array $ids = [],
        public array $tagIds = [],
        public string $keyword = "",
    ) {
    }
}

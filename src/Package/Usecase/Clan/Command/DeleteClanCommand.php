<?php

declare(strict_types=1);

namespace Package\Usecase\Clan\Command;

class DeleteClanCommand
{
    public function __construct(public string $id)
    {
    }
}

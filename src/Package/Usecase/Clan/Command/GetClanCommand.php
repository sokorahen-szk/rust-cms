<?php declare(strict_types=1);

namespace Package\Usecase\Clan\Command;

class GetClanCommand {
    public function __construct(public int $id){}
}
<?php declare(strict_types=1);

namespace Package\Usecase\Clan;

use Package\Usecase\Clan\Response\GetClanResponse;
use Package\Usecase\Clan\Command\GetClanCommand;

interface IClanInteractor {
    public function get(GetClanCommand $command): GetClanResponse;
}
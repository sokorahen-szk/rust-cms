<?php declare(strict_types=1);

namespace Package\Usecase\Clan;

use Package\Usecase\Clan\Command\CreateClanCommand;
use Package\Usecase\Clan\Command\GetClanCommand;
use Package\Usecase\Clan\Command\ListClanCommand;
use Package\Usecase\Clan\Response\GetClanResponse;
use Package\Usecase\Clan\Response\ListClanResponse;

interface IClanInteractor {
    /**
     * @param ListClanCommand $command
     * @return ListClanResponse
     */
    public function list(ListClanCommand $command): ListClanResponse;
    /**
     * @param GetClanCommand $command
     * @return GetClanResponse
     */
    public function get(GetClanCommand $command): GetClanResponse;
    /**
     * @param CreateClanCommand $command
     */
    public function create(CreateClanCommand $command): void;
}
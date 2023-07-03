<?php

declare(strict_types=1);

namespace Package\Usecase\Clan;

use Package\Domain\Clan\Repository\IClanRepository;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Infrastructure\Input\ListClanInput;
use Package\Usecase\Clan\Response\GetClanResponse;
use Package\Usecase\Clan\Command\GetClanCommand;
use Package\Usecase\Clan\Command\ListClanCommand;
use Package\Usecase\Clan\Response\ListClanResponse;

class ClanInteractor implements IClanInteractor
{
    /**
     * @param IClanRepository $clanRepository
     */
    public function __construct(private IClanRepository $clanRepository)
    {
    }

    public function get(GetClanCommand $command): GetClanResponse
    {
        $clan = $this->clanRepository->get(new ClanId($command->id));
        return new GetClanResponse($clan);
    }

    public function list(ListClanCommand $command): ListClanResponse
    {
        $clans = $this->clanRepository->list(
            new ListClanInput($command->ids)
        );
        return new ListClanResponse($clans);
    }
}

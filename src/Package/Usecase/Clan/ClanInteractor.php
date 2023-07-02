<?php

declare(strict_types=1);

namespace Package\Usecase\Clan;

use Package\Domain\Clan\Repository\IClanRepository;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Usecase\Clan\Response\GetClanResponse;
use Package\Usecase\Clan\Command\GetClanCommand;

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
}

<?php declare(strict_types=1);

namespace Package\Usecase\Clan;

use Package\Domain\Repository\IClanRepository;
use Package\Usecase\Clan\Response\GetClanResponse;
use Package\Usecase\Clan\Command\GetClanCommand;

class ClanInteractor implements IClanInteractor {
    /**
     * @param IClanRepository $clanRepository
     */
    public function __construct(IClanRepository $clanRepository) {}

    public function get(GetClanCommand $command): GetClanResponse
    {
        $clan = $this->clanRepository->get($command->id);
        return new GetClanResponse($clan);
    }
}
<?php declare(strict_types=1);

namespace Package\Usecase\Clan;

use Package\Domain\Clan\Entity\ClanFactory;
use Package\Domain\Clan\Repository\IClanRepository;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Infrastructure\Input\ListClanInput;
use Package\Usecase\Clan\Command\CreateClanCommand;
use Package\Usecase\Clan\Command\GetClanCommand;
use Package\Usecase\Clan\Command\ListClanCommand;
use Package\Usecase\Clan\Command\UpdateClanCommand;
use Package\Usecase\Clan\Command\DeleteClanCommand;
use Package\Usecase\Clan\Response\GetClanResponse;
use Package\Usecase\Clan\Response\ListClanResponse;

class ClanInteractor implements IClanInteractor
{
    /**
     * @param IClanRepository $clanRepository
     */
    public function __construct(
        private IClanRepository $clanRepository
    ) {
    }

    public function list(ListClanCommand $command): ListClanResponse
    {
        $clans = $this->clanRepository->list(
            new ListClanInput($command->ids, $command->tagIds, $command->keyword)
        );
        return new ListClanResponse($clans);
    }

    public function get(GetClanCommand $command): GetClanResponse
    {
        $clan = $this->clanRepository->get(new ClanId($command->id));
        return new GetClanResponse($clan);
    }

    public function create(CreateClanCommand $command): void
    {
        $factory = new ClanFactory(
            $command->name,
            $command->imageUrl,
            $command->introduction,
            $command->userId,
        );
        $this->clanRepository->create($factory->make());
    }

    public function update(UpdateClanCommand $command): void
    {
        $clan = $this->clanRepository->get(new ClanId($command->id));
        $clan->changeName($command->name);
        $clan->changeImageUrl($command->imageUrl);
        $clan->changeIntroduction($command->introduction);

        $this->clanRepository->update($clan);
    }

    public function delete(DeleteClanCommand $command): void
    {
        $this->clanRepository->delete(new ClanId($command->id));
    }
}

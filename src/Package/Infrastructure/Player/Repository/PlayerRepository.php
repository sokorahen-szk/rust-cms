<?php

declare(strict_types=1);

namespace Package\Infrastructure\Player\Repository;

use App\Models\PlayerModel;
use Package\Domain\Player\Entity\Player;
use Package\Domain\Player\Repository\IPlayerRepository;

class PlayerRepository implements IPlayerRepository
{
    /**
     * @param PlayerModel $playerModel
     */
    public function __construct(private PlayerModel $playerModel)
    {
    }

    public function create(Player $player): void
    {
        $this->clanModel->create([
            "id" => $player->id()->value(),
            "name" => $player->name()->value(),
            "clan_id" => $player->clanId() ?? $player->clanId()->value(),
            "battle_metrics_id" => $player->battleMetricsId(),
            "created_user_id" => $player->createdUserId() ?? $player->createdUserId()->value(),
            "updated_at" => $player->updatedAt()->toDateTimeString(),
            "created_at" => $player->createdAt()->toDateTimeString(),
        ]);
    }
}

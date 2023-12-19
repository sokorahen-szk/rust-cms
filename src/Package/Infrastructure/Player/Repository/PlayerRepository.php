<?php

declare(strict_types=1);

namespace Package\Infrastructure\Player\Repository;

use App\Models\PlayerModel;
use Package\Domain\Player\Entity\Player;
use Package\Domain\Player\Repository\IPlayerRepository;
use Package\Domain\Shared\Infrastructure\ModelToEntityConverter;

class PlayerRepository implements IPlayerRepository
{
    use ModelToEntityConverter;

    /**
     * @param PlayerModel $playerModel
     */
    public function __construct(private PlayerModel $playerModel)
    {
    }

    public function create(Player $player): Player
    {
        $model = $this->playerModel->create([
            "id" => $player->id()->value(),
            "name" => $player->name()->value(),
            "clan_id" => $player->clanId() ? $player->clanId()->value() : null,
            "battle_metrics_id" => $player->battleMetricsId(),
            "created_user_id" => $player->createdUserId() ? $player->createdUserId()->value() : null,
            "updated_at" => $player->updatedAt()->toDateTimeString(),
            "created_at" => $player->createdAt()->toDateTimeString(),
        ]);

        return $this->toPlayer($model);
    }
}

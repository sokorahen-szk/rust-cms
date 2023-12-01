<?php

declare(strict_types=1);

namespace Package\Infrastructure\Player\Repository;

use App\Models\PlayerModel;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Player\Entity\Player;
use Package\Domain\Player\Repository\IPlayerRepository;
use Package\Domain\Player\ValueObject\PlayerId;
use Package\Domain\Player\ValueObject\PlayerName;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\ValueObject\UserId;

class PlayerRepository implements IPlayerRepository
{
    /**
     * @param PlayerModel $playerModel
     */
    public function __construct(private PlayerModel $playerModel)
    {
    }

    public function create(Player $player): Player
    {
        $model = $this->clanModel->create([
            "id" => $player->id()->value(),
            "name" => $player->name()->value(),
            "clan_id" => $player->clanId() ?? $player->clanId()->value(),
            "battle_metrics_id" => $player->battleMetricsId(),
            "created_user_id" => $player->createdUserId() ?? $player->createdUserId()->value(),
            "updated_at" => $player->updatedAt()->toDateTimeString(),
            "created_at" => $player->createdAt()->toDateTimeString(),
        ]);

        return $this->toPlayer($model);
    }

    /**
     * @param PlayerModel $model
     * @return Player
     */
    private function toPlayer(PlayerModel $model): Player
    {
        return new Player(
            new PlayerId($model->id),
            new PlayerName($model->name),
            $model->clan_id ? new ClanId($model->clan_id) : null,
            $model->battle_metrics_id,
            new UserId($model->created_user_id),
            new Datetime($model->updated_at),
            new Datetime($model->created_at),
        );
    }
}

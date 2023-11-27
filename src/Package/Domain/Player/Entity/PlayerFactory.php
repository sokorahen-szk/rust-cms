<?php

declare(strict_types=1);

namespace Package\Domain\Player\Entity;

use Illuminate\Support\Str;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Player\ValueObject\PlayerId;
use Package\Domain\Player\ValueObject\PlayerName;
use Package\Domain\User\ValueObject\UserId;
use Package\Domain\Shared\ValueObject\Datetime;

class PlayerFactory
{
    public function __construct(
        private string $name,
        private string $clanId,
        private string $battleMetricsId,
        private string $createdUserId,
    ) {
    }

    /**
     * @return Player
     */
    public function make(): Player
    {
        $id = (string) Str::uuid();
        $now = now();
        return new Player(
            new PlayerId($id),
            new PlayerName($this->name),
            new ClanId($this->clanId),
            $this->battleMetricsId,
            new UserId($this->createdUserId),
            new Datetime($now),
            new Datetime($now),
        );
    }
}

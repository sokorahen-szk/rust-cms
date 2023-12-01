<?php

declare(strict_types=1);

namespace Package\Domain\Player\Entity;

use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Player\ValueObject\PlayerId;
use Package\Domain\Player\ValueObject\PlayerName;
use Package\Domain\Shared\BaseEntity as Entity;
use Package\Domain\User\ValueObject\UserId;
use Package\Domain\Shared\ValueObject\Datetime;

class Player extends Entity
{
    public function __construct(
        private PlayerId $id,
        private PlayerName $name,
        private ?ClanId $clanId,
        private ?string $battleMetricsId,
        private UserId $createdUserId,
        private Datetime $createdAt,
        private Datetime $updatedAt
    )
    {

    }

    public function id(): PlayerId
    {
        return $this->id;
    }

    public function name(): PlayerName
    {
        return $this->name;
    }

    public function clanId(): ?ClanId
    {
        return $this->clanId;
    }

    public function battleMetricsId(): ?string
    {
        return $this->battleMetricsId;
    }

    public function createdUserId(): UserId
    {
        return $this->createdUserId;
    }

    public function createdAt(): Datetime
    {
        return $this->createdAt;
    }

    public function updatedAt(): Datetime
    {
        return $this->updatedAt;
    }
}
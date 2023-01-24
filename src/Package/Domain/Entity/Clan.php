<?php declare(strict_types=1);

namespace Package\Domain\Entity;

use Package\Domain\ValueObject\Clan\ClanId;
use Package\Domain\ValueObject\Clan\ClanName;
use Package\Domain\ValueObject\Datetime;
use Package\Domain\BaseEntity as Entity;

class Clan extends Entity {
    public function __construct(
        private ClanId $id,
        private ClanName $name,
        private Datetime $createdAt,
        private Datetime $updatedAt
    ) {}

    public function id(): ClanId
    {
        return $this->id;
    }

    public function name(): ClanName
    {
        return $this->name;
    }

    public function createdAt(): Datetime
    {
        return $this->createdAt;
    }

    public function updatedAt(): Datetime
    {
        return $this->updatedAt;
    }

    public function changeName(string $name): void
    {
        $this->name = new ClanName($name);
    }
}
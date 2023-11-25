<?php

declare(strict_types=1);

namespace Package\Domain\Clan\Entity;

use Illuminate\Support\Str;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Clan\ValueObject\ClanName;
use Package\Domain\Clan\ValueObject\ImageUrl;
use Package\Domain\Clan\ValueObject\Introduction;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\ValueObject\UserId;
use Package\Domain\Clan\Entity\Clan;

class ClanFactory
{
    public function __construct(
        private string $name,
        private string $imageUrl,
        private string $introduction,
        private string $createdUserId,
    ) {
    }

    /**
     * @return Clan
     */
    public function make(): Clan
    {
        $id = (string) Str::uuid();
        $now = now();
        return new Clan(
            new ClanId($id),
            new ClanName($this->name),
            new ImageUrl($this->imageUrl),
            new Introduction($this->introduction),
            new UserId($this->createdUserId),
            new Datetime($now),
            new Datetime($now),
        );
    }
}

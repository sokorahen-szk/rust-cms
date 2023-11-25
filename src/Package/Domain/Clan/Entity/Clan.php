<?php

declare(strict_types=1);

namespace Package\Domain\Clan\Entity;

use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Clan\ValueObject\ClanName;
use Package\Domain\Clan\ValueObject\ImageUrl;
use Package\Domain\Clan\ValueObject\Introduction;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\Shared\BaseEntity as Entity;
use Package\Domain\User\ValueObject\UserId;

class Clan extends Entity
{
    public function __construct(
        private ClanId $id,
        private ClanName $name,
        private ImageUrl $imageUrl,
        private Introduction $introduction,
        private UserId $createdUserId,
        private Datetime $createdAt,
        private Datetime $updatedAt
    ) {
    }

    public function id(): ClanId
    {
        return $this->id;
    }

    public function name(): ClanName
    {
        return $this->name;
    }

    public function imageUrl(): ImageUrl
    {
        return $this->imageUrl;
    }

    public function introduction(): Introduction
    {
        return $this->introduction;
    }

    public function createdUserId(): UserId
    {
        return $this->createdUserId;
    }

    public function created(): Introduction
    {
        return $this->introduction;
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

    public function changeImageUrl(string $imageUrl): void
    {
        $this->imageUrl = new ImageUrl($imageUrl);
    }


    public function changeIntroduction(string $introduction): void
    {
        $this->introduction = new Introduction($introduction);
    }
}

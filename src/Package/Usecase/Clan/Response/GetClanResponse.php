<?php

declare(strict_types=1);

namespace Package\Usecase\Clan\Response;

use Package\Domain\Clan\Entity\Clan;
use Package\Domain\Shared\ValueObject\Datetime;

class GetClanResponse
{
    public string $id;
    public string $name;
    public string $imageUrl;
    public string $introduction;
    public Datetime $createdAt;
    public Datetime $updatedAt;
    /**
     * @param Clan $clan
     */
    public function __construct(private Clan $clan)
    {
        $this->id = $clan->id()->value();
        $this->name = $clan->name()->value();
        $this->imageUrl = $clan->imageUrl()->value();
        $this->introduction = $clan->introduction()->value();
        $this->createdAt = $clan->createdAt();
        $this->updatedAt = $clan->updatedAt();
    }
}

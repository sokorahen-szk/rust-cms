<?php

declare(strict_types=1);

namespace Package\Usecase\Clan\Response;

use Package\Domain\Clan\Entity\Clan;

class ListClanResponse
{
    /**
     * @var \StdClass[]
     */
    public array $data;
    /**
     * @param Clan[] $clans
     */
    public function __construct(private array $clans)
    {
        foreach ($clans as $clan) {
            $this->data[] = (object) [
                "id" => $clan->id()->value(),
                "name" => $clan->name()->value(),
                "imageUrl" => $clan->imageUrl()->value(),
                "introduction" => $clan->introduction()->value(),
                "createdAt" => $clan->createdAt(),
                "updatedAt" => $clan->updatedAt(),
            ];
        }
    }
}

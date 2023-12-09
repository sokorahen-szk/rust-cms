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
                "image_url" => $clan->imageUrl()->value(),
                "introduction" => $clan->introduction()->value(),
                "created_user_id" => $clan->createdUserId()->value(),
                "created_at" => $clan->createdAt(),
                "updated_at" => $clan->updatedAt(),
            ];
        }
    }
}

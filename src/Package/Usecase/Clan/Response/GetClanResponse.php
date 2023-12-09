<?php

declare(strict_types=1);

namespace Package\Usecase\Clan\Response;

use Package\Domain\Clan\Entity\Clan;
use Package\Domain\Shared\ValueObject\Datetime;

class GetClanResponse
{
    public string $id;
    public string $name;
    public string $image_url;
    public string $introduction;
    public string $created_user_id;
    public Datetime $created_at;
    public Datetime $updated_at;

    /**
     * @param Clan $clan
     */
    public function __construct(private Clan $clan)
    {
        $this->id = $clan->id()->value();
        $this->name = $clan->name()->value();
        $this->image_url = $clan->imageUrl()->value();
        $this->introduction = $clan->introduction()->value();
        $this->created_user_id = $clan->createdUserId()->value();
        $this->created_at = $clan->createdAt();
        $this->updated_at = $clan->updatedAt();
    }
}

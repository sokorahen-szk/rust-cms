<?php declare(strict_types=1);

namespace Package\Usecase\Clan\Response;

use Package\Domain\Entity\Clan;
use Package\Domain\ValueObject\Datetime;

class GetClanResponse {
    public int $id;
    public string $name;
    public Datetime $createdAt;
    public Datetime $updatedAt;
    /**
     * @param Clan $clan
     */
    public function __construct(private Clan $clan) {
        $this->id = $clan->id()->value();
        $this->name = $clan->name()->value();
        $this->createdAt = $clan->createdAt();
        $this->updatedAt = $clan->updatedAt();
    }
}
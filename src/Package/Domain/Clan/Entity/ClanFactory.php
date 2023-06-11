<?php

declare(strict_types=1);

namespace Package\Domain\Clan\Entity;

use Illuminate\Support\Str;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Clan\ValueObject\ClanName;
use Package\Domain\Shared\ValueObject\Datetime;

class ClanFactory
{
    public function __construct(
        private string $name
    ) {
    }

    /**
     * @return Package\Domain\Clan\Entity\Clan
     */
    public function make(): Clan
    {
        $id = (string) Str::uuid();
        $now = now();
        return new Clan(
            new ClanId($id),
            new ClanName($this->name),
            new Datetime($now),
            new Datetime($now),
        );
    }
}

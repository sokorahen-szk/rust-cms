<?php

declare(strict_types=1);

namespace Package\Domain\Clan\Repository;

use Package\Domain\Clan\Entity\Clan;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Infrastructure\Input\ListClanInput;

interface IClanRepository
{
    /**
     * @param ClanId $id
     * @return Clan
     */
    public function get(ClanId $id): Clan;
    /**
     * @param ListClanInput $input
     * @return Clan[]
     */
    public function list(ListClanInput $input): array;
    /**
     * @param Clan $clan
     * @return void
     */
    public function create(Clan $clan): void;
    /**
     * @param Clan $clan
     * @return void
     */
    public function update(Clan $clan): void;
    /**
     * @param ClanId $id
     * @return void
     */
    public function delete(ClanId $id): void;
}

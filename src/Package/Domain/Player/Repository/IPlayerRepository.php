<?php

declare(strict_types=1);

namespace Package\Domain\Player\Repository;

use Package\Domain\Player\Entity\Player;

interface IPlayerRepository {
    /**
     * @param Player $player
     * @return Player
     */
    public function create(Player $player): Player;
}

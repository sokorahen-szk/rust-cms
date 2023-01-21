<?php declare(strict_types=1);

namespace Package\Domain\Repository;

use Package\Domain\Entity\Clan;

interface IClanRepository {
    /**
     * @param integer $id
     * @return Clan
     */
    public function Get(int $id): Clan;
    /**
     * @return Clan[]
     */
    public function List(): array;
    /**
     * @param Clan $clan
     * @return void
     */
    public function Create(Clan $clan): void;
    /**
     * @param Clan $clan
     * @return void
     */
    public function Update(Clan $clan): void;
    /**
     * @param integer $id
     * @return void
     */
    public function Delete(int $id): void;
}

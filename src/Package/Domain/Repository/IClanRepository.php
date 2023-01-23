<?php declare(strict_types=1);

namespace Package\Domain\Repository;

use Package\Domain\Entity\Clan;
use Package\Usecase\Input\ListClanInput;

interface IClanRepository {
    /**
     * @param integer $id
     * @return Clan
     */
    public function get(int $id): Clan;
    /**
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
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void;
}

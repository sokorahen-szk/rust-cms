<?php declare(strict_types=1);

namespace Package\Domain\Entity;

use Package\Domain\ValueObject\Datetime;
use Package\Domain\BaseEntity as Entity;

class Clan extends Entity {
    public function __construct(
        private int $id,
        private string $name,
        private Datetime $createdAt,
        private Datetime $updatedAt
    ) {
        if ($id === 0) {
            throw new \InvalidArgumentException("clanIDの値が不正です。");
        }
        if (empty($name)) {
            throw new \InvalidArgumentException("clan名が正しく設定されていません。");
        }
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function createdAt(): Datetime
    {
        return $this->createdAt;
    }

    public function updatedAt(): Datetime
    {
        return $this->updatedAt;
    }
}
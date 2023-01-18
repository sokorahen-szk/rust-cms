<?php namespace Package\Domain\Entity;

use Package\BaseEntity;
use Carbon\Carbon;

class Clan extends BaseEntity {
    protected int $id;
    protected string $name;
    protected Carbon $createdAt;
    protected Carbon $updatedAt;

    public function __construct(array $vars) {
        parent::__construct($vars);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function createdAt(): Carbon
    {
        return $this->createdAt;
    }

    public function updatedAt(): Carbon
    {
        return $this->updatedAt;
    }
}
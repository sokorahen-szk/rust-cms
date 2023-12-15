<?php

declare(strict_types=1);

namespace Package\Domain\Tag\Entity;

use Package\Domain\Shared\BaseEntity;
use Package\Domain\Tag\ValueObject\TagId;

class Tag extends BaseEntity
{
    public function __construct(
        private TagId $id,
        private string $name,
        private ?string $description,
        private bool $isEnabled,
        private bool $isDisplayOnTop
    ) {
    }

    public function id(): TagId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function isDisplayOnTop(): bool
    {
        return $this->isDisplayOnTop;
    }
}

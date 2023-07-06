<?php

declare(strict_types=1);

namespace Package\Domain\Tag\Entity;

use Package\Domain\Shared\BaseEntity;
use Package\Domain\Tag\ValueObject\TagId;
use Package\Domain\Tag\ValueObject\TargetDomain;

class Tag extends BaseEntity
{
    public function __construct(
        private TagId $id,
        private string $name,
        private string $description,
        private TargetDomain $targetDomain,
        private bool $isEnabledA
    ) {
    }
}

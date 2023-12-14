<?php

declare(strict_types=1);

namespace Package\Domain\Tag\Repository;

use Package\Domain\Tag\Entity\Tag;
use Package\Infrastructure\Tag\Input\ListTagInput;

interface ITagRepository
{
    /**
     * @param ListTagInput $input
     * @return Tag[]
     */
    public function list(ListTagInput $input): array;
}

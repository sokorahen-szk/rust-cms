<?php

declare(strict_types=1);

namespace Package\Usecase\Tag\Response;

use Package\Domain\Tag\Entity\Tag;

class ListTagResponse
{
    /**
     * @var \StdClass[]
     */
    public array $data;
    /**
     * @param Tag[] $tags
     */
    public function __construct(private array $tags)
    {
        foreach ($tags as $tag) {
            $this->data[] = (object) [
                "id" => $tag->id()->value(),
                "name" => $tag->name(),
                "display_order" => $tag->displayOrder(),
            ];
        }
    }
}

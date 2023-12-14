<?php

declare(strict_types=1);

namespace Package\Infrastructure\Tag\Repository;

use App\Models\TagModel;
use Package\Domain\Tag\Entity\Tag;
use Package\Domain\Tag\Repository\ITagRepository;
use Package\Domain\Tag\ValueObject\TagId;
use Package\Infrastructure\Tag\Input\ListTagInput;

class TagRepository implements ITagRepository
{
    /**
     * @param TagModel $model
     */
    public function __construct(private TagModel $tagModel)
    {
    }

    public function list(ListTagInput $input): array
    {
        $models = $this->tagModel->whereIsDisplayOnTop($input->isDisplayOnTop)
            ->get();

        return $this->toTags($models);
    }

    /**
     * @param Collection $models
     * @return Tag[]
     */
    private function toTags(Collection $models): array
    {
        return $models->map(function ($model) {
            return $this->toTag($model);
        })->toArray();
    }

    private function toTag(TagModel $tagModel): Tag
    {
        return new Tag(
            new TagId($tagModel->id),
            $tagModel->name,
            $tagModel->description,
            $tagModel->is_enabled,
            $tagModel->is_display_on_top,
        );
    }
}

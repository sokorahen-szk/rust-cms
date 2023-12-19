<?php

declare(strict_types=1);

namespace Package\Infrastructure\Tag\Repository;

use App\Models\TagModel;
use Package\Domain\Tag\Entity\Tag;
use Package\Domain\Tag\Repository\ITagRepository;
use Package\Infrastructure\Tag\Input\ListTagInput;
use Illuminate\Database\Eloquent\Collection;
use Package\Domain\Shared\Infrastructure\ModelToEntityConverter;

class TagRepository implements ITagRepository
{
    use ModelToEntityConverter;

    /**
     * @param TagModel $model
     */
    public function __construct(private TagModel $tagModel)
    {
    }

    public function list(ListTagInput $input): array
    {
        $models = $this->tagModel->whereIsDisplayOnTop($input->isDisplayOnTop)
            ->whereIsEnabled($input->isEnabled)
            ->get();

        return $this->toEntities($models, Tag::class);
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
}

<?php

declare(strict_types=1);

namespace Package\Domain\Shared\Infrastructure;

use Package\Domain\Clan\Entity\Clan;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Clan\ValueObject\ClanName;
use Package\Domain\Shared\ValueObject\Datetime;
use App\Models\ClanModel;
use Illuminate\Database\Eloquent\Collection;
use Package\Domain\Clan\ValueObject\ImageUrl;
use Package\Domain\Clan\ValueObject\Introduction;
use Package\Domain\User\ValueObject\UserId;

trait ModelToEntityConverter
{
    /**
     * @param Collection $models
     * @return Clan[]
     */
    protected function toClans(Collection $models): array
    {
        return $models->map(function ($model) {
            return $this->toClan($model);
        })->toArray();
    }

    /**
     * @param ClanModel $model
     * @return Clan
     */
    protected function toClan(ClanModel $model): Clan
    {
        return new Clan(
            new ClanId($model->id),
            new ClanName($model->name),
            new ImageUrl($model->image_url),
            new Introduction($model->introduction),
            new UserId($model->created_user_id),
            new Datetime($model->created_at),
            new Datetime($model->updated_at)
        );
    }
}

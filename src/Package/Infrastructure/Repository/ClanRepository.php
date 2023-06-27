<?php

declare(strict_types=1);

namespace Package\Infrastructure\Repository;

use Package\Domain\Clan\Repository\IClanRepository;
use Package\Domain\Clan\Entity\Clan;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Clan\ValueObject\ClanName;
use Package\Domain\Shared\ValueObject\Datetime;
use App\Models\ClanModel;
use Package\Infrastructure\Input\ListClanInput;
use Illuminate\Database\Eloquent\Collection;
use Package\Domain\Clan\ValueObject\ImageUrl;
use Package\Domain\Clan\ValueObject\Introduction;
use Package\Domain\User\ValueObject\UserId;

class ClanRepository implements IClanRepository
{
    /**
     * @param ClanModel $clanModel
     */
    public function __construct(private ClanModel $clanModel)
    {
    }

    /**
     * @param ClanId $id
     * @return Clan
     * @throws ModelNotFoundException
     */
    public function get(ClanId $id): Clan
    {
        $model = $this->clanModel->findOrFail($id->value());
        return $this->toClan($model);
    }

    /**
     * @return Clan[]
     */
    public function list(ListClanInput $input): array
    {
        $models = $this->clanModel
            ->whereIn("id", $input->ids)
            ->get();
        return $this->toClans($models);
    }

    /**
     * @param Clan $clan
     * @return void
     */
    public function create(Clan $clan): void
    {
        $this->clanModel->create([
            "id" => $clan->id()->value(),
            "name" => $clan->name()->value(),
            "image_url" => $clan->imageUrl()->value(),
            "introduction" => $clan->introduction()->value(),
            "created_user_id" => $clan->createdUserId()->value(),
        ]);
    }

    /**
     * @param Clan $clan
     * @return void
     * @throws Exception
     */
    public function update(Clan $clan): void
    {
        $updateFlag = $this->clanModel->where("id", $clan->id()->value())
            ->update([
                "name" => $clan->name()->value(),
                "image_url" => $clan->imageUrl()->value(),
                "introduction" => $clan->introduction()->value(),
            ]);
        if (!(bool) $updateFlag) {
            throw new \Exception("failed to update clan.");
        }
    }

    /**
     * @param ClanId $id
     * @return void
     * @throws Exception
     */
    public function delete(ClanId $id): void
    {
        $deleteFlag = $this->clanModel->destroy($id->value());
        if (!(bool) $deleteFlag) {
            throw new \Exception("failed to delete clan.");
        }
    }

    /**
     * @param Collection $models
     * @return Clan[]
     */
    private function toClans(Collection $models): array
    {
        return $models->map(function ($model) {
            return $this->toClan($model);
        })->toArray();
    }

    /**
     * @param ClanModel $model
     * @return Clan
     */
    private function toClan(ClanModel $model): Clan
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

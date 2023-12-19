<?php

declare(strict_types=1);

namespace Package\Infrastructure\Clan\Repository;

use Package\Domain\Clan\Repository\IClanRepository;
use Package\Domain\Clan\Entity\Clan;
use Package\Domain\Clan\ValueObject\ClanId;
use App\Models\ClanModel;
use Package\Infrastructure\Clan\Input\ListClanInput;
use Package\Domain\Shared\Infrastructure\ModelToEntityConverter;

class ClanRepository implements IClanRepository
{
    use ModelToEntityConverter;

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
            ->whereKeywordSearch($input->splitKeywords())
            ->whereIn("id", $input->ids)
            ->orderBy("created_at", "desc")
            ->get();
        return $this->toEntities($models, Clan::class);
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
            "updated_at" => $clan->updatedAt()->toDateTimeString(),
            "created_at" => $clan->createdAt()->toDateTimeString(),
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
        $deleteFlag = $this->clanModel->findOrFail($id->value())->delete();
        if (!(bool) $deleteFlag) {
            throw new \Exception("failed to delete clan.");
        }
    }
}

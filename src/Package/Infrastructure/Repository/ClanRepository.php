<?php declare(strict_types=1);

namespace Package\Infrastructure\Repository;

use Package\Domain\Repository\IClanRepository;
use Package\Domain\Entity\Clan;
use Package\Domain\ValueObject\Clan\ClanId;
use Package\Domain\ValueObject\Clan\ClanName;
use Package\Domain\ValueObject\Datetime;
use App\Models\Eloquent\ClanModel;
use Package\Usecase\Input\ListClanInput;
use Illuminate\Database\Eloquent\Collection;

class ClanRepository implements IClanRepository {
    public function __construct(private ClanModel $clanModel)
    {}

    /**
     * @param integer $id
     * @return Clan
     * @throws ModelNotFoundException
     */
    public function get(int $id): Clan
    {
        $model = $this->clanModel->findOrFail($id);
        return new Clan(
            new ClanId($model->id),
            new ClanName($model->name),
            new Datetime($model->created_at),
            new Datetime($model->updated_at)
        );
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
        ]);
    }

    /**
     * @param Clan $clan
     * @return void
     */
    public function update(Clan $clan): void
    {
        $updateFlag = $this->clanModel->where("id", $clan->id()->value())
            ->update([
                "name" => $clan->name()->value(),
            ]);
        if (!(bool) $updateFlag) {
            throw new \Exception("failed to update clan.");
        }
    }

    /**
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->clanModel->destroy($id);
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
            new Datetime($model->created_at),
            new Datetime($model->updated_at)
        );
    }
}
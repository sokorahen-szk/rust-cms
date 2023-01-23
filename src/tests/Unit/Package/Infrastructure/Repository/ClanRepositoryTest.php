<?php namespace Tests\Unit\Package\Infrastructure\Repository;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Package\Infrastructure\Repository\ClanRepository;
use App\Models\Eloquent\ClanModel;
use Package\Domain\Entity\Clan;
use Package\Usecase\Input\ListClanInput;

it("get() id = 1のデータが存在している時、正しくデータが取得できること", function() {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => 1,
    ]);

    $actual = $repository->get(1);
    $this->assertEquals(1, $actual->id()->value());
    $this->assertInstanceOf(Clan::class, $actual);
});

it("get() id = 2のデータが存在しない時、エラーが発生すること", function() {
    $repository = new ClanRepository(new ClanModel());

    $repository->get(2);
})->throws(ModelNotFoundException::class);

it("list() id = 1, 2のデータが存在している時、2件返すこと", function() {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => 1,
    ]);
    ClanModel::factory()->create([
        "id" => 2,
    ]);
    $actuals = $repository->list(new ListClanInput(
        [1, 2]
    ));
    $this->assertCount(2, $actuals);
    $this->assertInstanceOf(Clan::class, $actuals[0]);
    $this->assertInstanceOf(Clan::class, $actuals[1]);
});
<?php namespace Tests\Unit\Package\Infrastructure\Repository;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Package\Infrastructure\Repository\ClanRepository;
use App\Models\Eloquent\ClanModel;
use Package\Domain\Entity\Clan;
use Package\Domain\ValueObject\Clan\ClanId;
use Package\Domain\ValueObject\Clan\ClanName;
use Package\Domain\ValueObject\Datetime;
use Package\Usecase\Input\ListClanInput;

test("get() id = 1のデータが存在している時、正しくデータが取得できること", function() {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => 1,
    ]);

    $actual = $repository->get(1);
    $this->assertEquals(1, $actual->id()->value());
    $this->assertInstanceOf(Clan::class, $actual);
});

test("get() id = 2のデータが存在しない時、取得エラーになること", function() {
    $repository = new ClanRepository(new ClanModel());

    $repository->get(2);
})->throws(ModelNotFoundException::class);

test("list() id = 1, 2のデータが存在している時、2件返すこと", function() {
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

test("list() id = 3のデータが存在しない時、0件で空を返すこと", function() {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => 1,
    ]);
    ClanModel::factory()->create([
        "id" => 2,
    ]);
    $actuals = $repository->list(new ListClanInput(
        [3]
    ));
    $this->assertCount(0, $actuals);
    $this->assertEquals([], $actuals);
});

test("create() id = 999のデータが作成できること", function() {
    $repository = new ClanRepository(new ClanModel());

    $createClan = new Clan(
        new ClanId(999),
        new ClanName("createClan"),
        new Datetime("2022-01-01 00:00:00"),
        new Datetime("2022-01-01 00:00:00")
    );

    $repository->create($createClan);

    $actual = $repository->get(999);
    $this->assertEquals(999, $actual->id()->value());
    $this->assertEquals("createClan", $actual->name()->value());
});

test("update() id = 1のデータの名前がfugaからhogeに更新されること", function() {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => 1,
        "name" => "fuga",
    ]);

    $beforeClan = $repository->get(1);
    $beforeClan->changeName("hoge");

    $repository->update($beforeClan);

    $afterClan = $repository->get(1);
    $this->assertEquals("hoge", $afterClan->name()->value());
});

test("update() id = 1のデータが存在しない時、更新エラーになること", function() {
    $repository = new ClanRepository(new ClanModel());

    $dummyClan = new Clan(
        new ClanId(1),
        new ClanName("dummy"),
        new Datetime("2022-01-01 00:00:00"),
        new Datetime("2022-01-01 00:00:00")
    );

    $repository->update($dummyClan);
})->throws(\Exception::class);

test("delete() id = 1のデータが削除できること", function() {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => 1,
    ]);

    $clan = $repository->get(1);
    $repository->delete($clan->id()->value());

    $actuals = $repository->list(new ListClanInput(
        [1]
    ));
    $this->assertCount(0, $actuals);
});

test("delete() id = 1のデータが存在しない時、削除エラーになること", function() {
    $repository = new ClanRepository(new ClanModel());

    $dummyClan = new Clan(
        new ClanId(1),
        new ClanName("dummy"),
        new Datetime("2022-01-01 00:00:00"),
        new Datetime("2022-01-01 00:00:00")
    );

    $repository->delete($dummyClan->id()->value());
})->throws(\Exception::class);
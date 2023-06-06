<?php

namespace Tests\Unit\Package\Infrastructure\Repository;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Package\Infrastructure\Repository\ClanRepository;
use App\Models\Eloquent\ClanModel;
use Package\Domain\Clan\Entity\Clan;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Clan\ValueObject\ClanName;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Infrastructure\Input\ListClanInput;

test("get() id = ca9e2714-ca0c-44bd-9e9d-6d072ff9281bのデータが存在している時、正しくデータが取得できること", function () {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => "ca9e2714-ca0c-44bd-9e9d-6d072ff9281b",
    ]);

    $actual = $repository->get(new ClanId("ca9e2714-ca0c-44bd-9e9d-6d072ff9281b"));
    $this->assertEquals("ca9e2714-ca0c-44bd-9e9d-6d072ff9281b", $actual->id()->value());
    $this->assertInstanceOf(Clan::class, $actual);
});

test("get() id = 96e18f71-1eda-4764-afd6-27d72cfb1857のデータが存在しない時、取得エラーになること", function () {
    $repository = new ClanRepository(new ClanModel());

    $repository->get(new ClanId("96e18f71-1eda-4764-afd6-27d72cfb1857"));
})->throws(ModelNotFoundException::class);

test("list() データが2件以上存在している時、複数データを返すこと", function () {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => "ca9e2714-ca0c-44bd-9e9d-6d072ff9281b",
    ]);
    ClanModel::factory()->create([
        "id" => "96e18f71-1eda-4764-afd6-27d72cfb1857",
    ]);
    $actuals = $repository->list(new ListClanInput(
        ["ca9e2714-ca0c-44bd-9e9d-6d072ff9281b", "96e18f71-1eda-4764-afd6-27d72cfb1857"]
    ));
    $this->assertCount(2, $actuals);
    $this->assertInstanceOf(Clan::class, $actuals[0]);
    $this->assertInstanceOf(Clan::class, $actuals[1]);
});

test("list() id = 3のデータが存在しない時、0件で空を返すこと", function () {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => "ca9e2714-ca0c-44bd-9e9d-6d072ff9281b",
    ]);
    ClanModel::factory()->create([
        "id" => "96e18f71-1eda-4764-afd6-27d72cfb1857",
    ]);
    $actuals = $repository->list(new ListClanInput(
        ["fc714b6c-bace-4d5c-bf56-aa304c36e19b"]
    ));
    $this->assertCount(0, $actuals);
    $this->assertEquals([], $actuals);
});

test("create() id = 64368edc-bd22-4d8e-b5ad-624dbf8288faのデータが作成できること", function () {
    $repository = new ClanRepository(new ClanModel());

    $createClan = new Clan(
        new ClanId("64368edc-bd22-4d8e-b5ad-624dbf8288fa"),
        new ClanName("createClan"),
        new Datetime("2022-01-01 00:00:00"),
        new Datetime("2022-01-01 00:00:00")
    );

    $repository->create($createClan);

    $actual = $repository->get(new ClanId("64368edc-bd22-4d8e-b5ad-624dbf8288fa"));
    $this->assertEquals("64368edc-bd22-4d8e-b5ad-624dbf8288fa", $actual->id()->value());
    $this->assertEquals("createClan", $actual->name()->value());
});

test("update() id = 64368edc-bd22-4d8e-b5ad-624dbf8288faのデータの名前がfugaからhogeに更新されること", function () {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => "64368edc-bd22-4d8e-b5ad-624dbf8288fa",
        "name" => "fuga",
    ]);

    $beforeClan = $repository->get(new ClanId("64368edc-bd22-4d8e-b5ad-624dbf8288fa"));
    $beforeClan->changeName("hoge");

    $repository->update($beforeClan);

    $afterClan = $repository->get(new ClanId("64368edc-bd22-4d8e-b5ad-624dbf8288fa"));
    $this->assertEquals("hoge", $afterClan->name()->value());
});

test("update() id = 8723c6cf-866e-4354-939e-411d28f596c1のデータが存在しない時、更新エラーになること", function () {
    $repository = new ClanRepository(new ClanModel());

    $dummyClan = new Clan(
        new ClanId("8723c6cf-866e-4354-939e-411d28f596c1"),
        new ClanName("dummy"),
        new Datetime("2022-01-01 00:00:00"),
        new Datetime("2022-01-01 00:00:00")
    );

    $repository->update($dummyClan);
})->throws(\Exception::class);

test("delete() id = a4750c83-e2e5-4524-89f7-6aafd5e3c70aのデータが削除できること", function () {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => "a4750c83-e2e5-4524-89f7-6aafd5e3c70a",
    ]);

    $clan = $repository->get(new ClanId("a4750c83-e2e5-4524-89f7-6aafd5e3c70a"));
    $repository->delete($clan->id());

    $actuals = $repository->list(new ListClanInput(
        ["a4750c83-e2e5-4524-89f7-6aafd5e3c70a"]
    ));
    $this->assertCount(0, $actuals);
});

test("delete() id = 399ce913-e659-4c8f-b332-960e136a2c4cのデータが存在しない時、削除エラーになること", function () {
    $repository = new ClanRepository(new ClanModel());

    $dummyClan = new Clan(
        new ClanId("399ce913-e659-4c8f-b332-960e136a2c4c"),
        new ClanName("dummy"),
        new Datetime("2022-01-01 00:00:00"),
        new Datetime("2022-01-01 00:00:00")
    );

    $repository->delete($dummyClan->id());
})->throws(\Exception::class);

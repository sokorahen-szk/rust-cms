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

test("get() id = CA9E2714-CA0C-44BD-9E9D-6D072FF9281Bのデータが存在している時、正しくデータが取得できること", function () {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => "CA9E2714-CA0C-44BD-9E9D-6D072FF9281B",
    ]);

    $actual = $repository->get(new ClanId("CA9E2714-CA0C-44BD-9E9D-6D072FF9281B"));
    $this->assertEquals("CA9E2714-CA0C-44BD-9E9D-6D072FF9281B", $actual->id()->value());
    $this->assertInstanceOf(Clan::class, $actual);
});

test("get() id = 96E18F71-1EDA-4764-AFD6-27D72CFB1857のデータが存在しない時、取得エラーになること", function () {
    $repository = new ClanRepository(new ClanModel());

    $repository->get(new ClanId("96E18F71-1EDA-4764-AFD6-27D72CFB1857"));
})->throws(ModelNotFoundException::class);

test("list() データが2件以上存在している時、複数データを返すこと", function () {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => "CA9E2714-CA0C-44BD-9E9D-6D072FF9281B",
    ]);
    ClanModel::factory()->create([
        "id" => "96E18F71-1EDA-4764-AFD6-27D72CFB1857",
    ]);
    $actuals = $repository->list(new ListClanInput(
        ["CA9E2714-CA0C-44BD-9E9D-6D072FF9281B", "96E18F71-1EDA-4764-AFD6-27D72CFB1857"]
    ));
    $this->assertCount(2, $actuals);
    $this->assertInstanceOf(Clan::class, $actuals[0]);
    $this->assertInstanceOf(Clan::class, $actuals[1]);
});

test("list() id = 3のデータが存在しない時、0件で空を返すこと", function () {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => "CA9E2714-CA0C-44BD-9E9D-6D072FF9281B",
    ]);
    ClanModel::factory()->create([
        "id" => "96E18F71-1EDA-4764-AFD6-27D72CFB1857",
    ]);
    $actuals = $repository->list(new ListClanInput(
        ["FC714B6C-BACE-4D5C-BF56-AA304C36E19B"]
    ));
    $this->assertCount(0, $actuals);
    $this->assertEquals([], $actuals);
});

test("create() id = 64368EDC-BD22-4D8E-B5AD-624DBF8288FAのデータが作成できること", function () {
    $repository = new ClanRepository(new ClanModel());

    $createClan = new Clan(
        new ClanId("64368EDC-BD22-4D8E-B5AD-624DBF8288FA"),
        new ClanName("createClan"),
        new Datetime("2022-01-01 00:00:00"),
        new Datetime("2022-01-01 00:00:00")
    );

    $repository->create($createClan);

    $actual = $repository->get(new ClanId("64368EDC-BD22-4D8E-B5AD-624DBF8288FA"));
    $this->assertEquals("64368EDC-BD22-4D8E-B5AD-624DBF8288FA", $actual->id()->value());
    $this->assertEquals("createClan", $actual->name()->value());
});

test("update() id = 64368EDC-BD22-4D8E-B5AD-624DBF8288FAのデータの名前がfugaからhogeに更新されること", function () {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => "64368EDC-BD22-4D8E-B5AD-624DBF8288FA",
        "name" => "fuga",
    ]);

    $beforeClan = $repository->get(new ClanId("64368EDC-BD22-4D8E-B5AD-624DBF8288FA"));
    $beforeClan->changeName("hoge");

    $repository->update($beforeClan);

    $afterClan = $repository->get(new ClanId("64368EDC-BD22-4D8E-B5AD-624DBF8288FA"));
    $this->assertEquals("hoge", $afterClan->name()->value());
});

test("update() id = 8723C6CF-866E-4354-939E-411D28F596C1のデータが存在しない時、更新エラーになること", function () {
    $repository = new ClanRepository(new ClanModel());

    $dummyClan = new Clan(
        new ClanId("8723C6CF-866E-4354-939E-411D28F596C1"),
        new ClanName("dummy"),
        new Datetime("2022-01-01 00:00:00"),
        new Datetime("2022-01-01 00:00:00")
    );

    $repository->update($dummyClan);
})->throws(\Exception::class);

test("delete() id = A4750C83-E2E5-4524-89F7-6AAFD5E3C70Aのデータが削除できること", function () {
    $repository = new ClanRepository(new ClanModel());

    ClanModel::factory()->create([
        "id" => "A4750C83-E2E5-4524-89F7-6AAFD5E3C70A",
    ]);

    $clan = $repository->get(new ClanId("A4750C83-E2E5-4524-89F7-6AAFD5E3C70A"));
    $repository->delete($clan->id());

    $actuals = $repository->list(new ListClanInput(
        [1]
    ));
    $this->assertCount(0, $actuals);
});

test("delete() id = 399CE913-E659-4C8F-B332-960E136A2C4Cのデータが存在しない時、削除エラーになること", function () {
    $repository = new ClanRepository(new ClanModel());

    $dummyClan = new Clan(
        new ClanId("399CE913-E659-4C8F-B332-960E136A2C4C"),
        new ClanName("dummy"),
        new Datetime("2022-01-01 00:00:00"),
        new Datetime("2022-01-01 00:00:00")
    );

    $repository->delete($dummyClan->id());
})->throws(\Exception::class);

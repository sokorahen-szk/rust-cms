<?php

namespace Tests\Unit\Package\Usecase;

use Package\Usecase\Clan\ClanInteractor;
use Mockery;
use Package\Domain\Clan\Entity\Clan;
use Package\Domain\Clan\Repository\IClanRepository;
use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Clan\ValueObject\ClanName;
use Package\Domain\Clan\ValueObject\ImageUrl;
use Package\Domain\Clan\ValueObject\Introduction;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\ValueObject\UserId;
use Package\Usecase\Clan\Command\GetClanCommand;
use Package\Usecase\Clan\Response\GetClanResponse;

test("get() 正しく取得できること", function () {
    $this->markTestSkipped();
    $expectedClan = new Clan(
        new ClanId("ca9e2714-ca0c-44bd-9e9d-6d072ff9281b"),
        new ClanName("クラン名"),
        new ImageUrl("hogehoge.jpg"),
        new Introduction("aiueo"),
        new UserId("f574055b-3f45-47a8-b0fd-c11363fbce75"),
        new Datetime("2023-01-01 00:00:00"),
        new Datetime("2023-01-01 23:59:59")
    );
    $mockClanRepository = Mockery::mock(IClanRepository::class);
    $mockClanRepository->shouldReceive("get")
        ->once()
        ->andReturn($expectedClan);


    $interactor = new ClanInteractor($mockClanRepository);

    $expected = new GetClanResponse($expectedClan);
    $actual = $interactor->get(new GetClanCommand("ca9e2714-ca0c-44bd-9e9d-6d072ff9281b"));
    $this->assertEquals($expected->id, $actual->id);
    $this->assertEquals($expected->name, $actual->name);
    $this->assertEquals($expected->imageUrl, $actual->imageUrl);
    $this->assertEquals($expected->introduction, $actual->introduction);
    $this->assertEquals($expected->createdAt, $actual->createdAt);
    $this->assertEquals($expected->updatedAt, $actual->updatedAt);
});

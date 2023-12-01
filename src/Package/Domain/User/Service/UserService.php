<?php

declare(strict_types=1);

namespace Package\Domain\User\Service;

use Package\Domain\User\Entity\UserFactory;
use Package\Domain\Player\Repository\IPlayerRepository;
use Package\Domain\User\Repository\IRoleRepository;
use Package\Domain\User\ValueObject\Permission;
use Package\Domain\User\Repository\IUserRepository;
use Package\Usecase\User\Command\CreateUserCommand;
use Illuminate\Support\Facades\DB;
use Package\Domain\Player\Entity\PlayerFactory;

class UserService implements IUserService{
    public function __construct(
        private IUserRepository $userRepository,
        private IPlayerRepository $playerRepository,
        private IRoleRepository $roleRepository
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function register(
        CreateUserCommand $createUserCommand
    ): void
    {
        DB::transaction(function() use ($createUserCommand) {
            $role = $this->roleRepository->getByDefaultPermission(new Permission(Permission::MEMBER));

            $userFactory = new UserFactory(
                $createUserCommand->accountId,
                $createUserCommand->name,
                $role->id()->value(),
                $createUserCommand->email,
                $createUserCommand->discordId,
                $createUserCommand->twitterId,
                $createUserCommand->steamId,
                $createUserCommand->password,
                $createUserCommand->description,
                null
            );

            $beforeCreationUser = $userFactory->makeGeneralUser();
            if (is_null($createUserCommand->email)) {
                $beforeCreationUser = $userFactory->makeGeneralUserWithNotSetEmail();

                // ここで認証用のメールトークンを発行する処理
                // メール送信　非同期
            }

            $createdUser = $this->userRepository->create($beforeCreationUser);

            $playerFactory = new PlayerFactory(
                $createUserCommand->name,
                $createUserCommand->clanId,
                $createUserCommand->battleMetricsId,
                $createdUser->id()->value()
            );
            $this->playerRepository->create($playerFactory->make());
        });
    }
}

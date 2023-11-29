<?php

declare(strict_types=1);

namespace Package\Domain\User\Service;

use Package\Domain\Player\Entity\UserFactory;
use Package\Domain\Player\Repository\IPlayerRepository;
use Package\Domain\User\Repository\IRoleRepository;
use Package\Domain\User\ValueObject\Permission;
use Package\Domain\User\Repository\IUserRepository;
use Package\Usecase\User\Command\CreateUserCommand;

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
        $role = $this->roleRepository->getByDefaultPermission(new Permission(Permission::MEMBER));

        $userFactory = new UserFactory(
            $createUserCommand->accountId,
            $createUserCommand->name,
            $role->value(),
            $createUserCommand->email,
            $createUserCommand->discordId,
            $createUserCommand->twitterId,
            $createUserCommand->steamId,
            $createUserCommand->password,
            $createUserCommand->description,
            $createUserCommand->createdUserId,
        );
        $this->userRepository->create($userFactory->makeGeneralUser());
    }
}
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
use Package\Domain\User\Entity\UserEmailVerifyTokenFactory;
use Package\Domain\User\Repository\IUserEmailVerifyTokenRepository;
use App\Mail\RegisterEmail;
use Illuminate\Support\Facades\Mail;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\ValueObject\UserEmailVerifyTokenId;

class UserService implements IUserService{
    public function __construct(
        private IUserRepository $userRepository,
        private IPlayerRepository $playerRepository,
        private IRoleRepository $roleRepository,
        private IUserEmailVerifyTokenRepository $userEmailVerifyTokenRepository
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
                $createUserCommand->createdUser,
            );

            $beforeCreationUser = $userFactory->makeGeneralUser();
            if (is_null($createUserCommand->email)) {
                $beforeCreationUser = $userFactory->makeGeneralUserWithNotSetEmail();
            }

            $createdUser = $this->userRepository->create($beforeCreationUser);

            if ($createdUser->isEmail()) {
                $userEmailVerifyTokenFactory = new UserEmailVerifyTokenFactory($beforeCreationUser->id()->value());
                $this->userEmailVerifyTokenRepository->create($userEmailVerifyTokenFactory->make());
            }

            $playerFactory = new PlayerFactory(
                $createUserCommand->name,
                $createUserCommand->clanId,
                $createUserCommand->battleMetricsId,
                $createdUser->id()->value()
            );
            $this->playerRepository->create($playerFactory->make());

            if ($createdUser->isEmail()) {
                Mail::to($createdUser->email()->value())->send(new RegisterEmail());
            }
    
            throw new \Exception("end");
        });
    }

    public function verifyEmail(UserEmailVerifyTokenId $userEmailVerifyTokenId): void
    {
        DB::transaction(function() use ($userEmailVerifyTokenId) {
            $userEmailVerifyToken = $this->userEmailVerifyTokenRepository->get($userEmailVerifyTokenId);
            $user = $this->userRepository->get($userEmailVerifyToken->userId());

            $user->changeEmailVeifiedAt(new Datetime(now()));
            $this->userRepository->update($user);

            $userEmailVerifyToken->changeVerified(true);
            $this->userEmailVerifyTokenRepository->update($userEmailVerifyToken);
        });
    }
}

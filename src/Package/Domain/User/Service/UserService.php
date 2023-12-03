<?php

declare(strict_types=1);

namespace Package\Domain\User\Service;

use App\Exceptions\AlreadyVerifiedException;
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

    const USER_SERVICE_REGISTER_COMPLETED = 1;
    const USER_SERVICE_REGISTER_COMPLETED_TEXT = "completed";

    const USER_SERVICE_REGISTER_WAITING_FOR_EMAIL_VERIFY = 2;
    const USER_SERVICE_REGISTER_WAITING_FOR_EMAIL_VERIFY_TEXT = "waiting_for_email_verify";

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
    ): int
    {
        return DB::transaction(function() use ($createUserCommand) {
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
                $createdUserEmailVerifyToken = $this->userEmailVerifyTokenRepository->create($userEmailVerifyTokenFactory->make());
            }

            $playerFactory = new PlayerFactory(
                $createUserCommand->name,
                $createUserCommand->clanId,
                $createUserCommand->battleMetricsId,
                $createdUser->id()->value()
            );
            $this->playerRepository->create($playerFactory->make());

            if ($createdUser->isEmail()) {
                Mail::to($createdUser->email()->value())->send(new RegisterEmail($createdUser, $createdUserEmailVerifyToken));

                return self::USER_SERVICE_REGISTER_WAITING_FOR_EMAIL_VERIFY;
            }
    
            return self::USER_SERVICE_REGISTER_COMPLETED;
        });
    }

    public function verifyEmail(UserEmailVerifyTokenId $userEmailVerifyTokenId): void
    {
        DB::transaction(function() use ($userEmailVerifyTokenId) {
            $userEmailVerifyToken = $this->userEmailVerifyTokenRepository->get($userEmailVerifyTokenId);

            if ($userEmailVerifyToken->verified()) {
                throw new AlreadyVerifiedException("既に認証済みメールアドレスです。");
            }

            if ($userEmailVerifyToken->expiresAt()->lt(now())) {
                throw new AlreadyVerifiedException("認証有効期限が切れています。");
            }

            $user = $this->userRepository->get($userEmailVerifyToken->userId());
            $changeActiveStatus = $user->status()->changeActive();
            $user->changeStatus($changeActiveStatus);
            $user->changeEmailVeifiedAt(new Datetime(now()));
            $this->userRepository->update($user);

            $userEmailVerifyToken->changeVerified(true);
            $this->userEmailVerifyTokenRepository->update($userEmailVerifyToken);
        });
    }
}

<?php declare(strict_types=1);

namespace Package\Usecase\User;

use Package\Domain\User\Repository\IUserRepository;
use Package\Domain\User\Service\IUserService;
use Package\Domain\User\Service\UserService;
use Package\Infrastructure\User\Input\ListUserInput;
use Package\Usecase\User\Command\CreateUserCommand;
use Package\Usecase\User\Command\ListUserCommand;
use Package\Usecase\User\Response\CreateUserResponse;
use Package\Usecase\User\Response\ListUserResponse;

class UserInteractor implements IUserInteractor
{
    /**
     * @param IUserService $userService
     * @param IUserRepository $userRepository
     */
    public function __construct(
        private IUserService $userService,
        private IUserRepository $userRepository
    ) {
    }

    public function create(CreateUserCommand $command): CreateUserResponse
    {
        $registerStatus = $this->userService->register($command);
        if ($registerStatus === UserService::USER_SERVICE_REGISTER_COMPLETED) {
            return new CreateUserResponse(UserService::USER_SERVICE_REGISTER_COMPLETED_TEXT);
        }

        if ($registerStatus === UserService::USER_SERVICE_REGISTER_WAITING_FOR_EMAIL_VERIFY) {
            return new CreateUserResponse(UserService::USER_SERVICE_REGISTER_WAITING_FOR_EMAIL_VERIFY_TEXT);
        }
    }

    public function list(ListUserCommand $command): ListUserResponse
    {
        $users = $this->userRepository->list(new ListUserInput($command->keywords));
        return new ListUserResponse($users);
    }
}

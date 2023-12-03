<?php declare(strict_types=1);

namespace Package\Usecase\User;

use Package\Domain\User\Service\IUserService;
use Package\Domain\User\Service\UserService;
use Package\Usecase\User\Command\CreateUserCommand;
use Package\Usecase\User\Response\CreateUserResponse;

class UserInteractor implements IUserInteractor
{
    /**
     * @param IUserService $userService
     */
    public function __construct(
        private IUserService $userService
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
}

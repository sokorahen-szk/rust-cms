<?php declare(strict_types=1);

namespace Package\Usecase\User;

use Package\Domain\User\Repository\IUserRepository;
use Package\Domain\User\Service\IUserService;
use Package\Usecase\User\Command\CreateUserCommand;

class UserInteractor implements IUserInteractor
{
    /**
     * @param IUserService $userService
     */
    public function __construct(
        private IUserService $userService
    ) {
    }

    public function create(CreateUserCommand $command): void
    {
        $this->userService->register($command);
    }
}

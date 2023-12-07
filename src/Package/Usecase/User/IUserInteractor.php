<?php declare(strict_types=1);

namespace Package\Usecase\User;

use Package\Usecase\User\Command\CreateUserCommand;
use Package\Usecase\User\Command\ListUserCommand;
use Package\Usecase\User\Response\CreateUserResponse;
use Package\Usecase\User\Response\ListUserResponse;

interface IUserInteractor {
    /**
     * @param CreateUserCommand $command
     * @return CreateUserResponse
     */
    public function create(CreateUserCommand $command): CreateUserResponse;

    /**
     * @param ListUserCommand $command
     * @return ListUserResponse
     */
    public function list(ListUserCommand $command): ListUserResponse;
}

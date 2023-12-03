<?php declare(strict_types=1);

namespace Package\Usecase\User;

use Package\Usecase\User\Command\CreateUserCommand;
use Package\Usecase\User\Response\CreateUserResponse;

interface IUserInteractor {
    public function create(CreateUserCommand $command): CreateUserResponse;
}

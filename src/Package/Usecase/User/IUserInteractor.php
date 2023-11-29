<?php declare(strict_types=1);

namespace Package\Usecase\User;

use Package\Usecase\User\Command\CreateUserCommand;

interface IUserInteractor {
    public function create(CreateUserCommand $command): void;
}

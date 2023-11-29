<?php

declare(strict_types=1);

namespace Package\Domain\User\Service;

use Package\Usecase\User\Command\CreateUserCommand;

interface IUserService {
    /**
     * @param CreateUserCommand $createUserCommand
     * @return void
     */
    public function register(CreateUserCommand $createUserCommand): void;
}
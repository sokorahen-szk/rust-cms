<?php

declare(strict_types=1);

namespace Package\Domain\User\Service;

use Package\Domain\User\ValueObject\UserEmailVerifyTokenId;
use Package\Usecase\User\Command\CreateUserCommand;

interface IUserService {
    /**
     * @param CreateUserCommand $createUserCommand
     * @return void
     */
    public function register(CreateUserCommand $createUserCommand): void;

    /**
     * @param UserEmailVerifyTokenId $userEmailVerifyTokenId
     * @return void
     */
    public function verifyEmail(UserEmailVerifyTokenId $userEmailVerifyTokenId): void;
}
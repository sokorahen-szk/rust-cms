<?php

declare(strict_types=1);

namespace Package\Domain\User\Repository;

use Package\Domain\User\Entity\UserEmailVerifyToken;
use Package\Domain\User\ValueObject\UserEmailVerifyTokenId;

interface IUserEmailVerifyTokenRepository
{
    /**
     * @param UserEmailVerifyToken $userEmailVerifyToken
     * @return UserEmailVerifyToken
     */
    public function create(UserEmailVerifyToken $userEmailVerifyToken): UserEmailVerifyToken;

    /**
     * @param UserEmailVerifyTokenId $id
     * @return UserEmailVerifyToken
     */
    public function get(UserEmailVerifyTokenId $id): UserEmailVerifyToken;

    /**
     * @param UserEmailVerifyToken $userEmailVerifyToken
     * @return void
     */
    public function update(UserEmailVerifyToken $userEmailVerifyToken): void;
}

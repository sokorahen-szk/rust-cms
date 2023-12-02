<?php

namespace App\Http\Controllers;

use Package\Domain\User\Service\IUserService;
use Package\Domain\User\ValueObject\UserEmailVerifyTokenId;

class UserController extends Controller
{
    public function __construct(IUserService $userService)
    {
    }

    public function verifyEmail($token)
    {
        $this->userService->verifyEmail(new UserEmailVerifyTokenId($token));

        // TODO:
    }
}

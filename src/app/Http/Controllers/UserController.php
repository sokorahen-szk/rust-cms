<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Package\Domain\User\Service\IUserService;
use Package\Domain\User\ValueObject\UserEmailVerifyTokenId;

class UserController extends Controller
{
    public function __construct(private IUserService $userService)
    {
    }

    public function login()
    {
        return Inertia::render("login");
    }

    public function list()
    {
        return view("pages.users.list");
    }

    public function verifyEmail($token)
    {
        $this->userService->verifyEmail(new UserEmailVerifyTokenId($token));

        return view("pages.register.email_verify_complete");
    }
}

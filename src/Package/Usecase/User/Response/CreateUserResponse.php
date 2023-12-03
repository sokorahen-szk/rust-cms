<?php

declare(strict_types=1);

namespace Package\Usecase\User\Response;

class CreateUserResponse
{
    public function __construct(public string $status)
    {

    }
}

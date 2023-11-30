<?php

declare(strict_types=1);

namespace Package\Usecase\User\Command;

class CreateUserCommand
{
    public function __construct(
        public string $accountId,
        public string $name,
        public ?string $email,
        public ?string $discordId,
        public ?string $twitterId,
        public ?string $steamId,
        public ?string $battleMetricsId,
        public string $password,
        public ?string $description,
    )
    {
    }
}

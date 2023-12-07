<?php

declare(strict_types=1);

namespace Package\Usecase\User\Response;

use Package\Domain\User\Entity\User;

class ListUserResponse
{
    /**
     * @var \StdClass[]
     */
    public array $data;
    /**
     * @param User[] $users
     */
    public function __construct(private array $users)
    {
        foreach ($users as $user) {
            $this->data[] = (object) [
                "id" => $user->id()->value(),
                "account_id" => $user->accountId()->value(),
            ];
        }
    }
}

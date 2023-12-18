<?php

declare(strict_types=1);

namespace Package\Usecase\User\Response;

use Package\Domain\User\Entity\UserPost;

class ListUserPostResponse
{
    /**
     * @var \StdClass[]
     */
    public array $data;
    /**
     * @param UserPost[] $userPosts
     */
    public function __construct(private array $userPosts)
    {
        foreach ($userPosts as $userPost) {
            $this->data[] = (object) [
                "id" => $userPost->id()->value(),
                "platform" => $userPost->platform()->value(),
                "platform" => $userPost->platform()->value(),
                "message" => $userPost->message(),
                "created_at" => $userPost->createdAt()->toDateTimeLocalString(),
            ];
        }
    }
}

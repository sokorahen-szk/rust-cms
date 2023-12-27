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
            $user = $userPost->getUser();
            $this->data[] = (object) [
                "id" => $userPost->id()->value(),
                "platform" => $userPost->platform()->value(),
                "category" => $userPost->category()->value(),
                "message" => $userPost->message(),
                "is_display_logged_in_user" => $userPost->isDisplayLoggedInUser(),
                "created_at" => $userPost->createdAt()->toDateTimeLocalString(),
                "close_at" => $userPost->closeAt() ? $userPost->closeAt()->toDateTimeLocalString() : null,
                "user" => (object) [
                    "account_id" => $user->accountId()->value(),
                    "twitter_id" => $user->twitterId(),
                    "discord_id" => $user->discordId(),
                    "steam_id" => $user->steamId(),
                    "avator_image" => $user->avatarImage()->value(),
                ],
            ];
        }
    }
}

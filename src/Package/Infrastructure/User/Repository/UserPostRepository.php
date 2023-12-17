<?php 

declare(strict_types=1);

namespace Package\Infrastructure\User\Repository;

use App\Models\UserPostModel;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\Entity\UserPost;
use Package\Domain\User\Repository\IUserPostRepository;
use Package\Domain\User\ValueObject\Platform;
use Package\Domain\User\ValueObject\UserId;
use Package\Domain\User\ValueObject\UserPostId;
use Package\Infrastructure\User\Input\ListUserPostInput;

class UserPostRepository implements IUserPostRepository
{
    public function __construct(UserPostModel $model)
    {
    }

    /**
     * @inheritDoc
     */
    public function list(ListUserPostInput $input): array
    {
        $models = $this->model->wherePlatforms($input->platforms)
            ->where("is_display_logged_in_user", $input->isLogin)
            ->sort($input->sortKey)
            ->get();

        return $this->toUserPosts($models);
    }

    /**
     * @param Collection $models
     * @return UserPost[]
     */
    private function toUserPosts(mixed $models): array
    {
        return $models->map(function ($model) {
            return $this->toUserPost($model);
        })->toArray();
    }

    /**
     * @param UserPostModel $model
     * @return UserPost
     */
    private function toUserPost(UserPostModel $model): UserPost
    {
        return new UserPost(
            new UserPostId($model->id),
            new Platform($model->platform),
            $model->message,
            (bool) $model->is_display_logged_in_user,
            new UserId($model->created_user_id),
            $model->close_at ? new Datetime($model->close_at) : null,
            new Datetime($model->createdAt),
        );
    }
}
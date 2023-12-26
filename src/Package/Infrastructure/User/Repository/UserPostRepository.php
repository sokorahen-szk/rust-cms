<?php 

declare(strict_types=1);

namespace Package\Infrastructure\User\Repository;

use App\Models\UserPostModel;
use Package\Domain\Shared\Infrastructure\ModelToEntityConverter;
use Package\Domain\User\Entity\UserPost;
use Package\Domain\User\Repository\IUserPostRepository;
use Package\Infrastructure\User\Input\ListUserPostInput;

class UserPostRepository implements IUserPostRepository
{
    use ModelToEntityConverter;

    public function __construct(private UserPostModel $model)
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
            ->with(["user"])
            ->rowLimit($input->limit)
            ->get();

        return $this->toEntities($models, UserPost::class);
    }
}

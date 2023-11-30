<?php

declare(strict_types=1);

namespace Package\Infrastructure\User\Repository;

use Package\Domain\User\Entity\User;
use Package\Domain\User\Repository\IUserRepository;
use Package\Domain\User\ValueObject\UserId;
use App\Models\User as UserModel;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\ValueObject\AccountId;
use Package\Domain\User\ValueObject\Email;
use Package\Domain\User\ValueObject\Password;
use Package\Domain\User\ValueObject\RoleId;
use Package\Domain\User\ValueObject\UserStatus;
use Package\Infrastructure\User\Input\ListUserInput;

class UserRepository implements IUserRepository {
    /**
     * @param UserModel $userModel
     */
    public function __construct(private UserModel $userModel)
    {
    }

    /**
     * @inheritDoc
     */
    public function get(UserId $id): User
    {
        $model = $this->userModel->findOrFail($id->value());
        return $this->toUser($model);
    }

    /**
     * @inheritDoc
     */
    public function list(ListUserInput $input): array
    {
        $models = $this->userModel
            ->get();
        return $this->toUsers($models);
    }

    /**
     * @inheritDoc
     */
    public function create(User $user): User
    {
        $model = $this->userModel->create([
            "id" => $user->id()->value(),
            "account_id" => $user->accountId()->value(),
            "name" => $user->name(),
            "status" => $user->status()->value(),
            "role_id" => $user->roleId()->value(),
            "email" => $user->email() ? $user->email()->value() : null,
            "email_verified_at" => $user->emailVeifiedAt() ? $user->emailVeifiedAt()->toDateTimeString() : null,
            "discord_id" => $user->discordId(),
            "twitter_id" => $user->twitterId(),
            "steam_id" => $user->steamId(),
            "password" => $user->password()->hashedText(),
            "description" => $user->description(),
            "created_user_id" => $user->createUserId() ? $user->createUserId()->value() : null,
            "created_at" => $user->createdAt()->toDateTimeString(),
            "updated_at" => $user->updatedAt()->toDateTimeString(),
        ]);
        return $this->toUser($model);
    }

    /**
     * @param Collection $models
     * @return User[]
     */
    private function toUsers(Collection $models): array
    {
        return $models->map(function ($model) {
            return $this->toUser($model);
        })->toArray();
    }

    /**
     * @param UserModel $model
     * @return User
     */
    private function toUser(UserModel $model): User
    {
        return new User(
            new UserId($model->id),
            new AccountId($model->account_id),
            $model->name,
            new UserStatus($model->status),
            new RoleId($model->role_id),
            new Email($model->email) ? $model->email : null,
            new Datetime($model->email_verified_at) ? $model->email_verified_at : null,
            $model->discord_id,
            $model->twitter_id,
            $model->steam_id,
            new Password($model->password),
            $model->description,
            new UserId($model->created_user_id) ? $model->created_user_id : null,
            new Datetime($model->created_at),
            new Datetime($model->updated_at)
        );
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    private function convert($data): mixed
    {
        if (issert($data)) {
            return $data;
        }

        return null;
    }
}
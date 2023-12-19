<?php

declare(strict_types=1);

namespace Package\Infrastructure\User\Repository;

use Package\Domain\User\Entity\User;
use Package\Domain\User\Repository\IUserRepository;
use Package\Domain\User\ValueObject\UserId;
use App\Models\User as UserModel;
use Package\Infrastructure\User\Input\ListUserInput;
use Package\Domain\Shared\Infrastructure\ModelToEntityConverter;

class UserRepository implements IUserRepository
{
    use ModelToEntityConverter;

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
            ->whereAccountId($input->keywords)
            ->paginate(15);
        return $this->toEntities($models, User::class);
    }

    /**
     * @inheritDoc
     */
    public function create(User $user): User
    {
        $model = $this->userModel->create([
            "id" => $user->id()->value(),
            "account_id" => $user->accountId()->value(),
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
     * @param User $user
     */
    public function update(User $user): void
    {
        $updateFlag = $this->userModel->where("id", $user->id()->value())
            ->update([
                "account_id" => $user->accountId()->value(),
                "status" => $user->status()->value(),
                "role_id" => $user->roleId()->value(),
                "email" => $user->email() ? $user->email()->value() : null,
                "email_verified_at" => $user->emailVeifiedAt() ? $user->emailVeifiedAt()->toDateTimeString() : null,
                "discord_id" => $user->discordId(),
                "twitter_id" => $user->twitterId(),
                "steam_id" => $user->steamId(),
                "description" => $user->description(),
            ]);

        if (!(bool) $updateFlag) {
            throw new \Exception("failed to update user.");
        }
    }
}

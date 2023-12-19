<?php

declare(strict_types=1);

namespace Package\Domain\Shared\Infrastructure;

use Illuminate\Database\Eloquent\Collection;
use App\Models\ClanModel;
use App\Models\PlayerModel;
use App\Models\TagModel;
use App\Models\RoleModel;
use App\Models\UserEmailVerifyTokenModel;
use App\Models\UserPostModel;
use App\Models\User as UserModel;

use Package\Domain\Clan\Entity\Clan;
use Package\Domain\Player\Entity\Player;
use Package\Domain\Tag\Entity\Tag;
use Package\Domain\User\Entity\Role;
use Package\Domain\User\Entity\UserPost;
use Package\Domain\User\Entity\UserEmailVerifyToken;
use Package\Domain\User\Entity\User;

use Package\Domain\Clan\ValueObject\ClanId;
use Package\Domain\Clan\ValueObject\ClanName;
use Package\Domain\Clan\ValueObject\ImageUrl;
use Package\Domain\Clan\ValueObject\Introduction;
use Package\Domain\Player\ValueObject\PlayerId;
use Package\Domain\Player\ValueObject\PlayerName;
use Package\Domain\Tag\ValueObject\TagId;
use Package\Domain\User\ValueObject\UserId;
use Package\Domain\User\ValueObject\Permission;
use Package\Domain\User\ValueObject\DefaultPermission;
use Package\Domain\User\ValueObject\PermissionLevel;
use Package\Domain\User\ValueObject\RoleId;
use Package\Domain\User\ValueObject\RoleName;
use Package\Domain\User\ValueObject\UserEmailVerifyTokenId;
use Package\Domain\User\ValueObject\Platform;
use Package\Domain\User\ValueObject\UserPostId;
use Package\Domain\User\ValueObject\AccountId;
use Package\Domain\User\ValueObject\Email;
use Package\Domain\User\ValueObject\Password;
use Package\Domain\User\ValueObject\UserStatus;
use Package\Domain\Shared\ValueObject\Datetime;

trait ModelToEntityConverter
{
    /**
     * @param ClanModel $model
     * @return Clan
     */
    protected function toClan(ClanModel $model): Clan
    {
        return new Clan(
            new ClanId($model->id),
            new ClanName($model->name),
            new ImageUrl($model->image_url),
            new Introduction($model->introduction),
            new UserId($model->created_user_id),
            new Datetime($model->created_at),
            new Datetime($model->updated_at)
        );
    }

    /**
     * @param PlayerModel $model
     * @return Player
     */
    protected function toPlayer(PlayerModel $model): Player
    {
        return new Player(
            new PlayerId($model->id),
            new PlayerName($model->name),
            $model->clan_id ? new ClanId($model->clan_id) : null,
            $model->battle_metrics_id,
            new UserId($model->created_user_id),
            new Datetime($model->updated_at),
            new Datetime($model->created_at),
        );
    }

    /**
     * @param TagModel $tagModel
     * @return Tag
     */
    protected function toTag(TagModel $tagModel): Tag
    {
        return new Tag(
            new TagId($tagModel->id),
            $tagModel->name,
            $tagModel->description,
            (bool) $tagModel->is_enabled,
            (bool) $tagModel->is_display_on_top,
        );
    }

    /**
     * @param RoleModel $roleModel
     * @return Role
     */
    protected function toRole(RoleModel $roleModel): Role
    {
        return new Role(
            new RoleId($roleModel->id),
            new RoleName($roleModel->name),
            new Permission($roleModel->permission),
            new PermissionLevel($roleModel->permission_level),
            new DefaultPermission($roleModel->default_permission),
            $roleModel->description
        );
    }

    /**
     * @param UserEmailVerifyTokenModel $model
     * @return UserEmailVerifyToken
     */
    protected function toUserEmailVerifyToken(UserEmailVerifyTokenModel $model): UserEmailVerifyToken
    {
        return new UserEmailVerifyToken(
            new UserEmailVerifyTokenId($model->id),
            new UserId($model->user_id),
            (bool) $model->verified,
            $model->expires_at ? new Datetime($model->expires_at) : null,
        );
    }

    /**
     * @param UserPostModel $model
     * @return UserPost
     */
    protected function toUserPost(UserPostModel $model): UserPost
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


    /**
     * @param Collection $models
     * @return User[]
     */
    private function toUsers(mixed $models): array
    {
        return $models->map(function ($model) {
            return $this->toUser($model);
        })->toArray();
    }

    /**
     * @param UserModel $model
     * @return User
     */
    protected function toUser(UserModel $model): User
    {
        return new User(
            new UserId($model->id),
            new AccountId($model->account_id),
            new UserStatus($model->status),
            new RoleId($model->role_id),
            $model->email ? new Email($model->email) : null,
            $model->email_verified_at ? new Datetime($model->email_verified_at) : null,
            $model->discord_id,
            $model->twitter_id,
            $model->steam_id,
            new Password($model->password, true),
            $model->description,
            $model->created_user_id ? new UserId($model->created_user_id) : null,
            new Datetime($model->created_at),
            new Datetime($model->updated_at)
        );
    }

    /**
     * @param Collection $models
     * @param string $className
     * @return mixed[]
     */
    protected function toEntities(Collection $models, string $className): array
    {
        $blocks = explode("\\", $className);
        $methodName = "to" . $blocks[count($blocks) - 1];
        if (!method_exists($this, $methodName)) {
            throw new \Exception("failed convert models to entities error.");
        }

        return $models->map(function ($model) use ($methodName) {
            return $this->{$methodName}($model);
        })->toArray();
    }
}

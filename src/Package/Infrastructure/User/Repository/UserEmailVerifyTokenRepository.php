<?php

declare(strict_types=1);

namespace Package\Infrastructure\User\Repository;

use Package\Domain\User\Repository\IUserEmailVerifyTokenRepository;
use App\Models\UserEmailVerifyTokenModel;
use Package\Domain\Shared\ValueObject\Datetime;
use Package\Domain\User\Entity\UserEmailVerifyToken;
use Package\Domain\User\ValueObject\UserEmailVerifyTokenId;
use Package\Domain\User\ValueObject\UserId;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserEmailVerifyTokenRepository implements IUserEmailVerifyTokenRepository {
    public function __construct(private UserEmailVerifyTokenModel $model)
    {
        
    }

    /**
     * @inheritDoc
     */
    public function get(UserEmailVerifyTokenId $id): UserEmailVerifyToken
    {
        $model = $this->model->where("id", $id->value())->first();

        if (is_null($model)) {
            throw new NotFoundHttpException("no user_email_verify_token record");
        }

        return $this->toUserEmailVerifyToken($model);
    }

    /**
     * @inheritDoc
     */
    public function create(UserEmailVerifyToken $userEmailVerifyToken): UserEmailVerifyToken
    {
        $model = $this->model->create([
            "id" => $userEmailVerifyToken->id()->value(),
            "user_id" => $userEmailVerifyToken->userId()->value(),
            "verified" => $userEmailVerifyToken->verified(),
            "expires_at" => $userEmailVerifyToken->expiresAt()->toDateTimeString(),
        ]);

        return $this->toUserEmailVerifyToken($model);
    }

    private function toUserEmailVerifyToken(UserEmailVerifyTokenModel $model): UserEmailVerifyToken
    {
        return new UserEmailVerifyToken(
            new UserEmailVerifyTokenId($model->id),
            new UserId($model->user_id),
            $$model->verified,
            $model->expires_at ? new Datetime($model->expires_at) : null,
        );
    }
}
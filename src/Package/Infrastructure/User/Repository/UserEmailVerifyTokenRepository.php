<?php

declare(strict_types=1);

namespace Package\Infrastructure\User\Repository;

use Package\Domain\User\Repository\IUserEmailVerifyTokenRepository;
use App\Models\UserEmailVerifyTokenModel;
use Package\Domain\User\Entity\UserEmailVerifyToken;
use Package\Domain\User\ValueObject\UserEmailVerifyTokenId;
use App\Exceptions\NotFoundRecordException;
use Package\Domain\Shared\Infrastructure\ModelToEntityConverter;

class UserEmailVerifyTokenRepository implements IUserEmailVerifyTokenRepository
{
    use ModelToEntityConverter;

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
            throw new NotFoundRecordException("no user_email_verify_token record");
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

    public function update(UserEmailVerifyToken $userEmailVerifyToken): void
    {
        $updateFlag = $this->model->where("id", $userEmailVerifyToken->id()->value())
            ->update([
                "verified" => $userEmailVerifyToken->verified(),
                "expires_at" => $userEmailVerifyToken->expiresAt()->toDateTimeString(),
            ]);

        if (!(bool) $updateFlag) {
            throw new \Exception("failed to update user_email_verify_token.");
        }
    }
}

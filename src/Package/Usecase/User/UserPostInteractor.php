<?php declare(strict_types=1);

namespace Package\Usecase\User;

use Package\Domain\User\Repository\IUserPostRepository;
use Package\Infrastructure\User\Input\ListUserPostInput;
use Package\Usecase\User\Command\ListUserPostCommand;
use Package\Usecase\User\Response\ListUserPostResponse;

class UserPostInteractor implements IUserPostInteractor
{
    public function __construct(
        private IUserPostRepository $userPostRepository
    ) {
    }

    /**
     * @inheritDoc
     */
    public function list(ListUserPostCommand $command): ListUserPostResponse
    {
        $userPosts = $this->userPostRepository->list(new ListUserPostInput(
            $command->isLogin,
            $command->platforms,
            $command->sortKey
        ));
        return new ListUserPostResponse($userPosts);
    }
}

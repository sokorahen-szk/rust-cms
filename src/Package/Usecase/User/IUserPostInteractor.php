<?php declare(strict_types=1);

namespace Package\Usecase\User;

use Package\Usecase\User\Command\ListUserPostCommand;
use Package\Usecase\User\Response\ListUserPostResponse;

interface IUserPostInteractor {
    /**
     * @param ListUserPostCommand $command
     * @return ListUserPostResponse
     */
    public function list(ListUserPostCommand $command): ListUserPostResponse;
}
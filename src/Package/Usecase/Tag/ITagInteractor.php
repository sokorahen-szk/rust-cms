<?php declare(strict_types=1);

namespace Package\Usecase\Tag;

use Package\Usecase\Tag\Command\ListTagCommand;
use Package\Usecase\Tag\Response\ListTagResponse;

interface ITagInteractor {
    /**
     * @param ListTagCommand $command
     * @return ListTagResponse
     */
    public function list(ListTagCommand $command): ListTagResponse;
}

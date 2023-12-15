<?php declare(strict_types=1);

namespace Package\Usecase\Tag;

use Package\Domain\Tag\Repository\ITagRepository;
use Package\Infrastructure\Tag\Input\ListTagInput;
use Package\Usecase\Tag\Command\ListTagCommand;
use Package\Usecase\Tag\Response\ListTagResponse;

class TagInteractor implements ITagInteractor
{
    public function __construct(private ITagRepository $tagRepository)
    {
    }

    public function list(ListTagCommand $command): ListTagResponse
    {
        $tags = $this->tagRepository->list(new ListTagInput(
            true,
            $command->isDisplayOnTop,
        ));
        return new ListTagResponse($tags);
    }
}

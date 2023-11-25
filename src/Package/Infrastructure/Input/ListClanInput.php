<?php

declare(strict_types=1);

namespace Package\Infrastructure\Input;

class ListClanInput
{
    public function __construct(
        public array $ids,
        public array $tagIds,
        private string $keyword
    ) {
    }

    /**
     * @return array
     */
    public function splitKeywords(): array
    {
        if (strlen($this->keyword) === 0) {
            return [];
        }

        $searchKeywords = explode('\s', $this->keyword);
        if (count($searchKeywords) === 0) {
            return [$this->keyword];
        }

        return $searchKeywords;
    }
}

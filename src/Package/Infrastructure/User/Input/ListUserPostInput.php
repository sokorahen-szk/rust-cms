<?php

declare(strict_types=1);

namespace Package\Infrastructure\User\Input;

class ListUserPostInput
{
    const SORT_KEY_CREATED_AT_DESC = "created_at#desc";

    public string $sortKey;

    public function __construct(public bool $isLogin, public ?array $platforms, ?string $sortKey)
    {
        if ($this->validateSortKey($sortKey)) {
            $this->sortKey = $sortKey;
        }
    }

    private function validateSortKey(?string $sortKey): bool
    {
        if (!is_null($sortKey)) {
            foreach ([
                self::SORT_KEY_CREATED_AT_DESC,
            ] as $s) {
                if ($sortKey === $s) {
                    return true;
                }
            }
        }

        return false;
    }
}

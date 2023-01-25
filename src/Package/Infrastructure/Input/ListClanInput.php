<?php declare(strict_types=1);

namespace Package\Infrastructure\Input;

class ListClanInput {
    public function __construct(public array $ids = [])
    {}
}
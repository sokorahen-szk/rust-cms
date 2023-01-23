<?php declare(strict_types=1);

namespace Package\Usecase\Input;

class ListClanInput {
    public function __construct(public array $ids = [])
    {}
}
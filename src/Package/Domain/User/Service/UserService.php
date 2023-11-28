<?php

declare(strict_types=1);

namespace Package\Domain\Service;

use Package\Domain\Clan\Repository\IUserRepository;
use Package\Domain\Player\Repository\IPlayerRepository;

class UserService {
    public function __construct(
        IUserRepository $userRepository,
        IPlayerRepository $playerRepository,
    )
    {
        
    }

    public function register()
    {
        // ユーザ作成
        // プレイヤー作成
        // タグ作成
    }
}
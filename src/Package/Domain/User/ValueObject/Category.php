<?php

namespace Package\Domain\User\ValueObject;

class Category
{
    const FRIEND_REQUEST = "フレンド募集";
    const CLAN_MEMBER_RECRUITING = "クランメンバー募集";
    const CLAN_MEMBER_REQUEST = "クランメンバー申請";
    const RAID_MERCENARY = "レイド要員";
    const OTHER = "その他";
    public function __construct(private string $value)
    {
        $categories = [
            self::FRIEND_REQUEST,
            self::CLAN_MEMBER_RECRUITING,
            self::CLAN_MEMBER_REQUEST,
            self::RAID_MERCENARY,
            self::OTHER,
        ];

        if (!in_array($value, $categories)) {
            throw new \Exception("unknown category value error");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

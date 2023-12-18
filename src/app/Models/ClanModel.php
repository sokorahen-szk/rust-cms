<?php

namespace App\Models;

use Database\Factories\ClanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClanModel extends Model
{
    use HasFactory;

    protected $table = "clans";

    protected $guarded = [];

    protected $keyType = 'string';

    public $incrementing = false;

    public function scopeWhereKeywordSearch($query, array $keywords)
    {
        $query = $this->whereName($query, $keywords);
        $query = $this->whereIntroduction($query, $keywords);
        return $query;
    }

    public function scopeWhereIn($query, string $key, array $ids)
    {
        if (count($ids) !== 0) {
            $query->whereIn($key, $ids);
        }

        return $query;
    }

    private function whereName($query, array $keywords)
    {
        foreach ($keywords as $keyword) {
            $query->orWhere("name", $keyword);
        }

        return $query;
    }

    private function whereIntroduction($query, array $keywords)
    {
        foreach ($keywords as $keyword) {
            $query->orWhere("introduction", $keyword);
        }

        return $query;
    }

    public function user()
    {
        return $this->hasOne(User::class, "id", "created_user_id");
    }

    protected static function newFactory()
    {
        return ClanFactory::new();
    }
}

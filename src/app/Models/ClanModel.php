<?php

namespace App\Models;

use Database\Factories\ClanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClanModel extends Model
{
    use HasFactory;

    protected $connection = "pgsql";

    protected $table = "clans";

    protected $guarded = [];

    protected $keyType = 'string';

    public function scopeWhereKeywordSearch($query, array $keywords)
    {
        $query = $this->whereName($query, $keywords);
        $query = $this->whereIntroduction($query, $keywords);
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
        return $this->hasMany(User::class, "id", "created_user_id");
    }

    protected static function newFactory()
    {
        return ClanFactory::new();
    }
}

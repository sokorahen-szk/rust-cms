<?php

namespace App\Models;

use Database\Factories\UserPostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPostModel extends Model
{
    use HasFactory;

    protected $table = "user_posts";

    protected $guarded = [];

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    public function scopeWherePlatforms($query, ?array $platforms)
    {
        if (count($platforms ?: []) > 0) {
            $query->whereIn("platform", $platforms);
        }

        return $query;
    }

    public function scopeSort($query, ?string $sortKey)
    {
        $sortSeparate = explode("#", $sortKey);
        if (!is_null($sortKey)) {
            $query->orderBy($sortSeparate[0], $sortSeparate[1]);
        }
        
        return $query;
    }

    public function user()
    {
        return $this->hasOne(User::class, "id", "created_user_id");
    }

    protected static function newFactory()
    {
        return UserPostFactory::new();
    }
}

<?php

namespace App\Models;

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
        if (count($platforms) > 0) {
            $query->whereIn("platforms", $platforms);
        }

        return $query;
    }

    public function scopeSort($query, ?string $sortKey)
    {
        $sortSeparate = explode("#", $sortKey);
        if (!is_null($sortKey)) {
            $query->orderBy($sortSeparate[0]. $sortSeparate[1]);
        }
        
        return $query;
    }
}

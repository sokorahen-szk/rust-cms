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

    public function user()
    {
        return $this->hasMany(User::class, "id", "created_user_id");
    }

    protected static function newFactory()
    {
        return ClanFactory::new();
    }
}

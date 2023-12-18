<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerModel extends Model
{
    use HasFactory;

    protected $table = "players";

    protected $guarded = [];

    protected $keyType = 'string';

    public $incrementing = false;

    public function user()
    {
        return $this->hasOne(User::class, "id", "created_user_id");
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}

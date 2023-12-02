<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmailVerifyTokenModel extends Model
{
    use HasFactory;

    protected $table = "user_email_verify_tokens";

    protected $guarded = [];

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    public function user()
    {
        return $this->hasMany(User::class, "id", "user_id");
    }

}

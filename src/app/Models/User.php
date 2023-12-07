<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;

    protected $table = "users";

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "id",
        "account_id",
        "name",
        "status",
        "role_id",
        "email",
        "email_verified_at",
        "discord_id",
        "twitter_id",
        "steam_id",
        "password",
        "description",
        "created_user_id",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        "password",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function scopeWhereAccountId($query, ?string $keywords)
    {
        if (!is_null($keywords)) {
            $query->where("account_id", $keywords);
        }
        return $query;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

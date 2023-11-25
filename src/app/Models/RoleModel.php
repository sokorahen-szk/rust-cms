<?php

namespace App\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

    protected $table = "roles";

    protected $guarded = [];

    protected $keyType = 'string';

    public $timestamps = false;

    public $incrementing = false;

    protected static function newFactory()
    {
        return RoleFactory::new();
    }
}

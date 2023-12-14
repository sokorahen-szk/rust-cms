<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    use HasFactory;

    protected $table = "tags";

    protected $guarded = [];

    protected $keyType = 'string';

    public $timestamps = false;

    public $incrementing = false;

    public function scopeWhereIsDisplayOnTop($query, ?bool $isDisplayOnTop)
    {
        if (!is_null($isDisplayOnTop)) {
            $query->where("is_display_on_top", $isDisplayOnTop);
        }

        return $query;
    }
}
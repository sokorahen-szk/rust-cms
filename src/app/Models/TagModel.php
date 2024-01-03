<?php

namespace App\Models;

use Database\Factories\TagFactory;
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

    public function scopeWhereIsEnabled($query, ?bool $isEnabled)
    {
        if (!is_null($isEnabled)) {
            $query->where("is_enabled", $isEnabled);
        }

        return $query;
    }

    protected static function newFactory()
    {
        return TagFactory::new();
    }
}

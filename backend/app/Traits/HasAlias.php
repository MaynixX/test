<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasAlias
{
    protected static function booted()
    {
        static::creating(function ($item) {
            if (empty($item->alias)) {
                $item->alias = Str::slug($item->title);
            }

            $count = 1;
            while (static::where('alias', $item->alias)->exists()) {
                $item->alias = Str::slug($item->title) . '-' . $count;
                $count++;
            }
        });
    }
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', $value)->orWhere('alias', $value)->first();
    }
}
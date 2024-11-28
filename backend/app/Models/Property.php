<?php

namespace App\Models;

use App\Models\DataType;
use App\Traits\HasAlias;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory, HasAlias;


    protected $guarded = [];
    public function dataType()
    {
        return $this->belongsTo(DataType::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_property')
                    ->withPivot('value')
                    ->withTimestamps();
    }
}

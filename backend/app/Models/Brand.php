<?php

namespace App\Models;

use App\Traits\HasAlias;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, HasAlias;

    protected $guarded = [];
    public function products(){
        return $this->hasMany(Product::class);
    }
}

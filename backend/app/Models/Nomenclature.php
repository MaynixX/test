<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomenclature extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'nomenclature_property');
    }
    public function parent(){
        return $this->belongsTo(Nomenclature::class, "parent_id");
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function productProperties(){
        return $this->properties()->where("is_selector", false);
    }
    public function tradeOfferProperties(){
        return $this->properties()->where("is_selector", true);
    }
}

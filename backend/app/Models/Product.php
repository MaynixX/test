<?php

namespace App\Models;

use App\Models\Nomenclature;
use App\Models\ProductImage;
use App\Models\TradeOffer;
use App\Traits\HasAlias;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasAlias;

    protected $guarded = [];
    public function nomenclature()
    {
        return $this->belongsTo(Nomenclature::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function documents()
    {
        return $this->hasMany(ProductDocument::class);
    }
    public function tradeOffers()
    {
        return $this->hasMany(TradeOffer::class);
    }
    public function properties()
    {
        return $this->belongsToMany(Property::class, 'product_property')
                    ->withPivot('value')
                    ->withTimestamps();
    }
}

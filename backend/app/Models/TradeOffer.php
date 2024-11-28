<?php

namespace App\Models;

use App\Models\Property;
use App\Traits\HasAlias;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeOffer extends Model
{
    use HasFactory, HasAlias;
    protected $guarded = [];
    public function properties()
    {
        return $this->belongsToMany(Property::class, 'trade_offer_property')
                    ->withPivot('value')
                    ->withTimestamps();
    }
    public function images()
    {
        return $this->hasMany(TradeOfferImage::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
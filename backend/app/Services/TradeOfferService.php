<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Property;
use App\Models\TradeOffer;

class TradeOfferService{
    public static function createTradeOfferByRequestData(array $array) : TradeOffer{
        if(key_exists("properties", $array)){
            $properties = $array['properties'];
            unset($array['properties']);
        }
        $tradeOffer = TradeOffer::create($array);
        if(isset($properties)){
            $property_data = [];
            foreach ($properties as $property_alias => $value) {
                $property_id = Property::where("alias", $property_alias)->first()->id;
                $property_data[$property_id] = ['value' => $value];
            }
            $tradeOffer->properties()->sync($property_data);
        }
        return $tradeOffer;
    }
    public static function updateTradeOfferByRequestData(TradeOffer $tradeOffer, array $array) : void{
        if(key_exists("properties", $array)){
            $properties = $array['properties'];
            unset($array['properties']);
        }
        $tradeOffer->update($array);
        if(isset($properties)){
            $property_data = [];
            foreach ($properties as $property_alias => $value) {
                $property_id = Property::where("alias", $property_alias)->first()->id;
                $property_data[$property_id] = ['value' => $value];
            }
            $tradeOffer->properties()->syncWithoutDetaching($property_data);
        }
    }
}
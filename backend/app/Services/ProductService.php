<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Property;

class ProductService{
    public static function createProductByRequestData(array $array) : Product{
        if(key_exists("properties", $array)){
            $properties = $array['properties'];
            unset($array['properties']);
        }
        $product = Product::create($array);
        if(isset($properties)){
            $property_data = [];
            foreach ($properties as $property_alias => $value) {
                $property_id = Property::where("alias", $property_alias)->first()->id;
                $property_data[$property_id] = ['value' => $value];
            }
            $product->properties()->sync($property_data);
        }
        return $product;
    }
    public static function updateProductByRequestData(Product $product, array $array) : void{
        if(key_exists("properties", $array)){
            $properties = $array['properties'];
            unset($array['properties']);
        }
        $product->update($array);
        if(isset($properties)){
            $property_data = [];
            foreach ($properties as $property_alias => $value) {
                $property_id = Property::where("alias", $property_alias)->first()->id;
                $property_data[$property_id] = ['value' => $value];
            }
            $product->properties()->syncWithoutDetaching($property_data);
        }
    }
}
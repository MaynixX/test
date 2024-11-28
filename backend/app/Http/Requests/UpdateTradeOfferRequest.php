<?php

namespace App\Http\Requests;

use App\Models\Nomenclature;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTradeOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $array = [
            "title" => ["nullable", "string", "max:255"],
            "alias" => ["nullable", "string", "max:255", "unique:trade_offers,alias"],
            "preview_image" => [
                "nullable",
                'image',
                'mimes:jpeg,jpg,png,gif,svg,webp,bmp,tiff,ico,heic,heif',
                'max:2048'
            ],
            "sku" => ["nullable", "string", "max:255", "unique:trade_offers,sku"],
            "price" => ["nullable", "numeric", "min:0"],
            "old_price" => ["nullable", "numeric", "min:0"],
            "is_active" => ["nullable", "boolean"]
        ];
        $nomenclature = $this->route("tradeOffer")->product->nomenclature;
        if($nomenclature->tradeOfferProperties()->count() > 0){
            $array['properties'] = ["nullable", "array"];
            foreach($nomenclature->tradeOfferProperties as $property){
                $array['properties.'.$property->alias] = ["nullable", $property->dataType->validation];
            }
        }
        return $array;
    }
}

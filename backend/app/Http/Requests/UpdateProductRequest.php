<?php

namespace App\Http\Requests;

use App\Models\Nomenclature;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            "alias" => ["nullable", "string", "max:255", "unique:products,alias",$this->route("product")->id],
            "category_id" => ["nullable", "exists:categories,id"],
            "brand_id" => ["nullable", "exists:brands,id"],
            "tags" => ["nullable", "string", "max:4000"],
            "preview_image" => [
                "nullable",
                'image',
                'mimes:jpeg,jpg,png,gif,svg,webp,bmp,tiff,ico,heic,heif',
                'max:2048'
            ],
            "description" => ["nullable", "string", "max:4000"],
            "access_level" => ["nullable", "int"],
            "seo_title" => ["nullable", "string", "max:255"],
            "seo_description" => ["nullable", "string", "max:255"],
            "is_active" => ["nullable", "boolean"],
            "gift" => ["nullable", "string", "max:255"]
        ];

        $nomenclature = @Nomenclature::find($this->nomenclature_id);
        if($nomenclature == null){
            $nomenclature = $this->route("product")->nomenclature;
        }
        if($nomenclature->productProperties()->count() > 0){
            $array['properties'] = ["nullable", "array"];
            foreach($nomenclature->productProperties as $property){
                $array['properties.'.$property->alias] = ["nullable", $property->dataType->validation];
            }
        }
        return $array;
    }
}

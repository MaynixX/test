<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Rules\CategoryExistsOrZero;
use App\Rules\PreventCyclicCategoryParent;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        return [
            "title" => ["nullable", "string", "max:255"],
            "alias" => [
                "nullable", 
                "string", 
                "max:255", 
                "unique:categories,alias,".$this->route("category")->id
            ],
            "parent_id" => [
                'nullable', 
                new CategoryExistsOrZero, 
                new PreventCyclicCategoryParent($this->route("category")->id)
            ],
            "description" => ["nullable", "string", "max:4000"],
            "icon" => [
                "nullable",
                'image',
                'mimes:jpeg,jpg,png,gif,svg,webp,bmp,tiff,ico,heic,heif',
                'max:2048'
            ],
            "image" => [
                "nullable",
                'image',
                'mimes:jpeg,jpg,png,gif,svg,webp,bmp,tiff,ico,heic,heif',
                'max:2048'
            ],
            "seo_title" => ["nullable", "string", "max:255"],
            "seo_description" => ["nullable", "string", "max:255"],
            "add_to_sitemap" => ["nullable", "boolean"],
            "nofollow" => ["nullable", "boolean"],
            "is_active" => ["nullable", "boolean"]
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\CategoryExistsOrZero;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            "title" => ["required", "string", "max:255"],
            "alias" => ["nullable", "string", "max:255", "unique:categories,alias"],
            "parent_id" => ['nullable', new CategoryExistsOrZero],
            "description" => ["required", "string", "max:4000"],
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

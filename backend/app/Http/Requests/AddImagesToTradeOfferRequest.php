<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddImagesToTradeOfferRequest extends FormRequest
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
            "images" => ["required", "array"],
            "images.*.file" => [
                "required",
                'image',
                'mimes:jpeg,jpg,png,gif,svg,webp,bmp,tiff,ico,heic,heif',
                'max:2048'
            ],
            "images.*.caption" => [
                "nullable",
                'string',
                'max:255'
            ]
        ];
    }
}

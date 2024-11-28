<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDocumentsToProductRequest extends FormRequest
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
            "documents" => ["required", "array"],
            "documents.*.file" => [
                "required",
                'mimes:jpeg,jpg,png,gif,svg,webp,bmp,tiff,ico,heic,heif,pdf,doc,docx,txt',
                'max:20480'
            ],
            "documents.*.caption" => [
                "nullable",
                'string',
                'max:255'
            ]
        ];
    }
}

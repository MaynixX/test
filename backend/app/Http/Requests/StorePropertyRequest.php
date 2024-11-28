<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            "data_type_id" => ['required', "exists:data_types,id"],
            "sort_order" => ['nullable', "integer"],
            "is_multiple" => ['nullable', "boolean"],
            "is_selector" => ['nullable', "boolean"],
            "show_in_characteristics" => ['nullable', "boolean"],
            "show_in_filters" => ['nullable', "boolean"]
        ];
    }
}

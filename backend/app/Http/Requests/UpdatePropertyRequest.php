<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
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
            "alias" => ["nullable", "string", "max:255", "unique:properties,alias,".$this->route("property")->id],
            "data_type_id" => ['nullable', "exists:data_types,id"],
            "sort_order" => ['nullable', "integer"],
            "is_multiple" => ['nullalbe', "boolean"],
            "is_selector" => ['nullalbe', "boolean"],
            "show_in_characteristics" => ['nullalbe', "boolean"],
            "show_in_filters" => ['nullalbe', "boolean"]
        ];
    }
}

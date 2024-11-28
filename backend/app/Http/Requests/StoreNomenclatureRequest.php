<?php

namespace App\Http\Requests;

use App\Models\Nomenclature;
use App\Rules\CategoryExistsOrZero;
use App\Rules\NomenclatureExistsOrZero;
use Illuminate\Foundation\Http\FormRequest;

class StoreNomenclatureRequest extends FormRequest
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
            "parent_id" => [
                'nullable', 
                new NomenclatureExistsOrZero
            ],
        ];
    }
}

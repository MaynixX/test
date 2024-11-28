<?php

namespace App\Http\Requests;

use App\Models\Nomenclature;
use App\Rules\NomenclatureExistsOrZero;
use App\Rules\PreventCyclicNomenclatureParent;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNomenclatureRequest extends FormRequest
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
            "parent_id" => [
                'nullable', 
                new NomenclatureExistsOrZero, 
                new PreventCyclicNomenclatureParent($this->route("nomenclature")->id)
            ],
        ];
    }
}

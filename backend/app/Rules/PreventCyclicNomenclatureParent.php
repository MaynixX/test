<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Nomenclature;

class PreventCyclicNomenclatureParent implements ValidationRule
{

    protected $nomenclatureId;

    public function __construct(int $nomenclatureId)
    {
        $this->nomenclatureId = $nomenclatureId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == $this->nomenclatureId) {
            $fail('The nomenclature cannot be its own parent.');
            return;
        }

        if ($this->isDescendant($value)) {
            $fail('The selected parent nomenclature creates a circular reference.');
            return;
        }
    }

    protected function isDescendant(int $parentId): bool
    {
        $nomenclature = Nomenclature::find($parentId);
        while ($nomenclature) {
            if ($nomenclature->id == $this->nomenclatureId) {
                return true;
            }
            $nomenclature = $nomenclature->parent; 
        }

        return false; 
    }
}

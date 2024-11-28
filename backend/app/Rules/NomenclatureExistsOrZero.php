<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class NomenclatureExistsOrZero implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Разрешаем значение 0
        if ($value == 0) {
            return;
        }

        // Проверяем, существует ли значение в таблице categories
        $exists = DB::table('nomenclatures')->where('id', $value)->exists();

        if (!$exists) {
            $fail('The selected nomenclature is invalid.');
        }
    }
}

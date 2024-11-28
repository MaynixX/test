<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Category;

class PreventCyclicCategoryParent implements ValidationRule
{

    protected $categoryId;

    public function __construct(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == $this->categoryId) {
            $fail('The category cannot be its own parent.');
            return;
        }

        if ($this->isDescendant($value)) {
            $fail('The selected parent category creates a circular reference.');
            return;
        }
    }

    protected function isDescendant(int $parentId): bool
    {
        $category = Category::find($parentId);
        while ($category) {
            if ($category->id == $this->categoryId) {
                return true;
            }
            $category = $category->parent; 
        }

        return false; 
    }
}

<?php

namespace App\Models;

use App\Traits\HasAlias;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasAlias;

    protected $fillable = ['title', 'alias'];

    public function products(){
        return $this->hasMany(Product::class);
    }
    public function parent(){
        return $this->belongsTo(Category::class, "parent_id");
    }
    public function getCategoriesStack() : array
    {
        $stack = [];
        $category = $this;

        while ($category) {
            $stack[] = $category;  
            $category = $category->parent;  
        }

        return array_reverse($stack);
    }
    public function getUri(): string
    {
        $categoryStack = $this->getCategoriesStack();
        
        $aliases = [];

        foreach ($categoryStack as $category) {
            $aliases[] = $category->alias;  
        }

        return implode('/', $aliases);
    }
}

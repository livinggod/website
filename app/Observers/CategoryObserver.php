<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    public function creating(Category $category): void
    {
        $category->name = ucwords($category->name);
        $category->slug = Str::slug($category->name);
    }

    public function updating(Category $category): void
    {
        $category->name = ucwords($category->name);
        $category->slug = Str::slug($category->name);
    }
}

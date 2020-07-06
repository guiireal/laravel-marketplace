<?php

namespace App\Http\Views;

use App\Models\Category;
use Illuminate\View\View;

class CategoryView
{
    public function composer(View $view)
    {
        $categories = Category::all(['name', 'slug']);
        $view->with('categories', $categories);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{
    public function index()
    {
        /** @var Collection $products */
        $products = Product::query()->limit(6)
            ->orderByDesc('id')
            ->get();
        $stores = Store::query()->limit(3)->get();
        return view('welcome', compact('products', 'stores'));
    }

    public function productShow(string $slug)
    {
        /** @var Product $product */
        $product = Product::whereSlug($slug)->firstOrFail();

        return view('product', compact('product'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;


class HomeController extends Controller
{
    public function index()
    {
        /** @var Collection $products */
        $products = Product::query()->limit(9)
            ->orderByDesc('id')
            ->get();

        return view('welcome', compact('products'));
    }

    public function productShow(string $slug)
    {
        /** @var Product $product */
        $product = Product::whereSlug($slug)->firstOrFail();

        return view('product', compact('product'));
    }
}

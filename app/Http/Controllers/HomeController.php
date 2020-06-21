<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;


class HomeController extends Controller
{
    public function index()
    {
        /** @var Collection $products */
        $products = Product::query()->limit(8)
            ->orderByDesc('id')
            ->get();

        return view('welcome', compact('products'));
    }

    public function single(string $slug)
    {
        /** @var Product $product */
        $product = Product::whereSlug($slug)->first();

        return view('single', compact('product'));
    }
}

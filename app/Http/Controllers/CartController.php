<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        dd(session()->get('cart'));
    }
    public function add(Request $request)
    {
        /** @var array $product */
        $product = $request->input('product');

        $this->upsertSession('cart', $product);
        flash('Produto adicionado no carrinho!')->success();
        return redirect()->route('product.show', ['slug' => $product['slug']]);
    }

    private function upsertSession(string $key, array $product): void
    {
        if (session()->has($key))
            session()->push($key, $product);
        else {
            $products[] = $product;
            session()->put($key, $products);
        }
    }
}

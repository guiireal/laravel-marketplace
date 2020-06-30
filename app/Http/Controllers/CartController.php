<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        /** @var array $product */
        $product = $request->input('product');

        $this->upsertSession('cart', $product);
        flash('Produto adicionado no carrinho!')->success();
        return redirect()->route('product.show', ['slug' => $product['slug']]);
    }

    public function remove(string $slug)
    {
        if (!session()->has('cart'))
            return redirect()->route('cart.index');
        $products = session()->get('cart');
        $products = array_filter($products, function ($item) use ($slug) {
            return $item['slug'] !== $slug;
        });

        session()->put('cart', $products);
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        session()->forget('cart');
        flash('Desistência da compra realizada com sucesso!')->success();
        return redirect()->route('cart.index');
    }

    private function upsertSession(string $key, array $product): void
    {
        if (session()->has($key)) {
            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug');
            if (in_array($product['slug'], $productsSlugs)) {
                $products = $this->productIncrement($product['slug'], $product['qty'], $products);
                session()->put('cart', $products);
            } else
                session()->push($key, $product);
        } else {
            $products[] = $product;
            session()->put($key, $products);
        }
    }

    private function productIncrement(string $slug, int $qty, array $products): array
    {
        $products = array_map(function ($item) use ($slug, $qty) {
            if ($slug === $item['slug'])
                $item['qty'] += $qty;
            return $item;
        }, $products);

        return $products;
    }
}

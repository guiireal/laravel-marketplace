<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Traits\UploadTrait;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    use UploadTrait;

    /** @var Product $product */
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        /** @var Store $userStore */
        $userStore = auth()->user()->store;
        $products = $userStore->products()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all(['id', 'name']);
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $formData = $request->all();
        $categories = $request->get('categories',null);

        /** @var Store $store */
        $store = auth()->user()->store;

        /** @var Product $product */
        $product = $store->products()->create($formData);
        $product->categories()->sync($categories);

        if ($request->hasFile('photos')) {
            $photos = $this->uploadPhotos($request->file('photos'), 'image');
            $product->photos()->createMany($photos);
        }
        flash('Produto Criado com Sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    public function edit(int $id)
    {
        $product = $this->product->query()->findOrFail($id);
        $categories = Category::all(['id', 'name']);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, int $id)
    {
        $formData = $request->all();
        $categories = $request->get('categories',null);

        /** @var Product $product */
        $product = $this->product->query()->findOrfail($id);

        $product->update($formData);
        if (!is_null($categories))
            $product->categories()->sync($categories);

        if ($request->hasFile('photos')) {
            $photos = $this->uploadPhotos($request->file('photos'), 'image');
            $product->photos()->createMany($photos);
        }
        flash('Produto Atualizado com Sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            flash('Produto Removido com Sucesso!')->success();
            return redirect()->route('admin.products.index');
        } catch (Exception $exception) {
            Log::debug($exception->getCode());
            die();
        }
    }
}

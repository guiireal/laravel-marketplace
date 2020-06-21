<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * @var Category $category
     */
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->query()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $formData = $request->all();

        $this->category->query()->create($formData);
        flash('Categoria Criada com Sucesso!')->success();
        return redirect()->route('admin.categories.index');
    }

    public function edit($category)
    {
        $category = $this->category->query()->findOrFail($category);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $formData = $request->all();

        $category = $this->category->query()->find($category);
        $category->update($formData);

        flash('Categoria Atualizada com Sucesso!')->success();
        return redirect()->route('admin.categories.index');
    }

    public function destroy($category)
    {
        $category = $this->category->query()->find($category);
        $category->delete();

        flash('Categoria Removida com Sucesso!')->success();
        return redirect()->route('admin.categories.index');
    }
}

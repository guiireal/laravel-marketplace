<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index()
    {
        $store = auth()->user()->store;
        return view('admin.stores.index', compact('store'));
    }

    public function create()
    {
        return view('admin.stores.create');
    }

    public function store(StoreRequest $request)
    {
        $formData = $request->all();


        /** @var User $user */
        $user = auth()->user();
        if ($request->hasFile('logo')) {
            $formData['logo'] = $this->uploadPhotos($request->file('logo'));
        }
        /** @var Store $store */
        $user->store()->create($formData);
        flash('Loja Criada com Sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit(Store $store)
    {
        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, Store $store)
    {
        $store->update($request->all());
        if ($request->hasFile('logo')) {
            if (Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }
            $formData['logo'] = $this->uploadPhotos($request->file('logo'));
        }
        flash('Loja Atualizada com Sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy(Store $store)
    {
        try {
            $store->delete();
            flash('Loja Removida com Sucesso!')->success();
            return redirect()->route('admin.stores.index');
        } catch (Exception $exception) {
            Log::debug($exception->getCode());
            die();
        }
    }
}

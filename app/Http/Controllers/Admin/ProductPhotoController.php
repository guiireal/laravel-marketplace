<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductPhoto;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function destroy(ProductPhoto $productPhoto)
    {
        if (Storage::disk('public')->exists($productPhoto->image))
            Storage::disk('public')->delete($productPhoto->image);

        try {
            $productId = $productPhoto->product->id;
            $productPhoto->delete();
        } catch (Exception $e) {
            Log::debug("Erro ao remover a foto! {$e->getTraceAsString()}");
        }
        flash('Foto removida com sucesso!')->success();
        return redirect()
            ->route('admin.products.edit', [
                'product' => $productId
            ]);
    }
}

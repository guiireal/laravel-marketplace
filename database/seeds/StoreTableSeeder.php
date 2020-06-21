<?php

use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    public function run()
    {
        /** @var Collection $stores */
        $stores = Store::all();

        /** @var Store $store */
        foreach ($stores as $store)
            $store->products()->save(factory(Product::class)->make());
    }
}

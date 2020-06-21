<?php

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 40)->create()->each(function (User $user) {
            $user->store()->save(factory(Store::class)->make());
        });
    }
}

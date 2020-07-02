<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PagSeguro\Library;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Library::initialize();
        Library::cmsVersion()->setName('Marketplace')->setRelease('1.0.0');
        Library::moduleVersion()->setName('Marketplace')->setRelease('1.0.0');
    }
}

<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use PagSeguro\Library;

class PagSeguroServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        try {
            Library::initialize();
            Library::cmsVersion()->setName('Marketplace')->setRelease('1.0.0');
            Library::moduleVersion()->setName('Marketplace')->setRelease('1.0.0');
        } catch (Exception $e) {
            Log::debug($e->getTraceAsString());
        }
    }
}

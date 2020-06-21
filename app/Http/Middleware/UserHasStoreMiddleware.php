<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserHasStoreMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!empty(auth()->user()->store) && auth()->user()->store->count()) {
            flash('Você já possui uma loja!')->warning();
            return redirect()->route('admin.stores.index');
        }
        return $next($request);
    }
}

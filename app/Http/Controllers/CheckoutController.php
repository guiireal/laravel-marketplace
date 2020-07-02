<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use PagSeguro\Configuration\Configure;
use PagSeguro\Services\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!auth()->check())
            return redirect()->route('login');

        $this->makePagSeguroSession();
        return view('checkout');
    }

    private function makePagSeguroSession()
    {
        if (!session()->has('pagseguro_session_code')) {
            try {
                $sessionCode = Session::create(Configure::getAccountCredentials());
                session()->put('pagseguro_session_code', $sessionCode->getResult());
            } catch (Exception $e) {
                Log::debug($e->getTraceAsString());
            }
        }
    }
}

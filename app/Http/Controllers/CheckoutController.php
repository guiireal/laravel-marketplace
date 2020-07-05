<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PagSeguro\CreditCardPayment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PagSeguro\Configuration\Configure;
use PagSeguro\Services\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!auth()->check())
            return redirect()->route('login');

        if (!session()->has('cart'))
            return redirect()->route('home');

        $this->makePagSeguroSession();
        $cartItems = array_map(
            fn($item) => $item['qty'] * $item['price'],
            session()->get('cart')
        );
        $purchaseTotal = array_sum($cartItems);
        return view('checkout', compact('purchaseTotal'));
    }

    public function process(Request $request)
    {
        $formData = $request->all();
        $cartItems = session()->get('cart');

        /** @var User $user */
        $user = auth()->user();

        $reference = 'XPTO';
        try {
            $creditCardPayment = new CreditCardPayment($user, $cartItems, $formData, $reference);
            $result = $creditCardPayment->doPayment();
            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => json_encode($cartItems, JSON_UNESCAPED_UNICODE),
                'store_id' => 41
            ];
            $user->orders()->create($userOrder);
            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado cum sucesso!',
                    'order' => $reference
                ]
            ]);

        } catch(Exception $exception) {
            $technicalErrorMessage = env('APP_DEBUG') ? $exception->getMessage() : '';
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => "Erro ao processar pedido! {$technicalErrorMessage}",
                ]
            ], 400);
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    private function makePagSeguroSession()
    {
        session()->forget('pagseguro_session_code');
        try {
            $sessionCode = Session::create(Configure::getAccountCredentials());
            session()->put('pagseguro_session_code', $sessionCode->getResult());
        } catch (Exception $e) {
            Log::debug($e->getTraceAsString());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $user = Auth::user();

        // Check if address exists, if not create one
        $address = $user->address;
        if ($address) {
            $address->update($request->all());
        } else {
            Address::create(array_merge($request->all(), ['user_id' => $user->id]));
        }

        // process checkout
        $code = 'STORE-' . mt_rand(0000000, 9999999);
        $carts = Cart::with(['product', 'user'])
            ->where('users_id', Auth::user()->id)
            ->get();

        // Transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $carts->sum(fn ($cart) => $cart->quantity * $cart->product->price),
            'transaction_status' => 'PENDING',
            'code' => $code,
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX' . mt_rand(0000000, 9999999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->quantity * $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx,
            ]);
        }

        // Configuration Midtrans
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $transaction->total_price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone_number,
            ],
            'enable_payments' => [
                'credit_card', 'gopay', 'permata_va', 'bank_transfer'
            ],
            'credit_card' => [
                'bank' => $request->bank,
                'number' => $request->card_number,
                'expiration_month' => $request->card_expiry_month,
                'expiration_year' => $request->card_expiry_year,
                'cvv' => $request->card_cvv,
            ],
            'expiry' => [
                'month' => $request->card_expiry_month,
                'year' => $request->card_expiry_year,
            ],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class CheckoutController extends Controller
{

    public function process(Request $request)
    {
        $user = Auth::user();

        // Check if address exists, if not create one
        $address = $user->address;
        if (!$address) {
            return redirect()->route('cart-products.index')->with('error', 'Mohon atur alamat pengiriman Anda terlebih dahulu.');
        }

        // process checkout
        $code = 'STORE-' . mt_rand(0000000, 9999999);
        $cartIds = explode(',', $request->cart_ids);

        if (empty($cartIds)) {
            return redirect()->back()->with('error', 'No products selected for checkout.');
        }

        $carts = Cart::whereIn('id', $cartIds)->with('product')->get();
        $totalPrice = $carts->sum(fn ($cart) => $cart->quantity * $cart->product->price);

        // Ensure total price is greater than 0
        if ($totalPrice <= 0) {
            return redirect()->back()->with('error', 'Total price must be greater than zero.');
        }

        // Transaction create
        $transaction = Transaction::create([
            'users_id' => $user->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $totalPrice,
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

            // Reduce product stock
            $cart->product->decrement('stock', $cart->quantity);
        }

        // Clear selected cart items
        Cart::whereIn('id', $cartIds)->delete();

        // Configuration Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $totalPrice,
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
                'secure' => true
            ]
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function callback(Request $request)
    {
        // Set configuration midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Instance midtrans notification
        $notification = new Notification();

        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                } else {
                    $transaction->status = 'SUCCESS';
                }
            }
        } else if ($status == 'settlement') {
            $transaction->status = 'SUCCESS';
        } else if ($status == 'pending') {
            $transaction->status = 'PENDING';
        } else if ($status == 'deny') {
            $transaction->status = 'CANCELLED';
        } else if ($status == 'expire') {
            $transaction->status = 'CANCELLED';
        } else if ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }

        // Simpan transaksi
        $transaction->save();

        // Kirimkan email
        if ($transaction) {
            if ($status == 'capture' && $fraud == 'accept') {
                //
            } else if ($status == 'settlement') {
                //
            } else if ($status == 'success') {
                //
            } else if ($status == 'capture' && $fraud == 'challenge') {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challenge'
                    ]
                ]);
            } else {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment not Settlement'
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Success'
                ]
            ]);
        }
    }


    public function checkoutSuccess()
    {
        return view('frontend.checkout-success');
    }
}

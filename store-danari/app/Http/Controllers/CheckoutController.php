<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $user = Auth::user();
        $code = 'STORE-' . mt_rand(0000000, 9999999);
        $selectedCartIds = explode(',', $request->cart_ids);
        $totalPrice = $request->input('total_price');

        // Check if address exists, if not create one
        $address = $user->address;
        if (!$address) {
            return redirect()->route('cartItem-products.index')->with('error', 'Mohon atur alamat pengiriman Anda terlebih dahulu.');
        }

        if (empty($selectedCartIds)) {
            return redirect()->back()->with('error', 'No products selected for checkout.');
        }

        $cartItems = Cart::whereIn('id', $selectedCartIds)->with('product')->get();
        $totalPrice = $cartItems->sum(fn ($cartItem) => $cartItem->quantity * $cartItem->product->price);

        // Ensure total price is greater than 0
        if ($totalPrice <= 0) {
            return redirect()->back()->with('error', 'Total price must be greater than zero.');
        }

        // Create transaction
        $transaction = Transaction::create([
            'users_id' => $user->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $totalPrice,
            'transaction_status' => 'PENDING',
            'code' => $code,
        ]);

        foreach ($cartItems as $cartItem) {
            $trx = 'TRX' . mt_rand(0000000, 9999999);
            $quantity = $request->input('quantity_' . $cartItem->id);
            if ($quantity) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cartItem->product->id,
                'price' => $cartItem->quantity * $cartItem->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx,
            ]);

            $product = $cartItem->product;
            $product->decrement('stock', $cartItem->quantity);
        }

        // Clear selected cart items
        Cart::whereIn('id', $selectedCartIds)->delete();

        // Configuration Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => $totalPrice,
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
            ],
            'item_details' => $cartItems->map(function ($cartItem) {
                return [
                    'id' => $cartItem->product->id,
                    'price' => $cartItem->product->price,
                    'quantity' => $cartItem->quantity,
                    'name' => $cartItem->product->name,
                ];
            })->toArray(),
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return view('frontend.checkout-success', compact('snapToken', 'totalPrice'));
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

        // Extract the transaction code from the order_id
        $code = explode('-', $order_id)[1];

        // Find transaction by code
        $transaction = Transaction::where('code', $code)->firstOrFail();

        // Log received status for debugging
        Log::info("Midtrans Notification Received for Order ID: {$order_id} with status: {$status}");

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->transaction_status = 'PENDING';
                } else {
                    $transaction->transaction_status = 'SUCCESS';
                }
            }
        } elseif ($status == 'settlement') {
            $transaction->transaction_status = 'SUCCESS';
        } elseif ($status == 'pending') {
            $transaction->transaction_status = 'PENDING';
        } elseif ($status == 'deny') {
            $transaction->transaction_status = 'CANCELLED';
        } elseif ($status == 'expire') {
            $transaction->transaction_status = 'CANCELLED';
        } elseif ($status == 'cancel') {
            $transaction->transaction_status = 'CANCELLED';
        }

        // Save transaction
        $transaction->save();

        // Log transaction update for debugging
        Log::info("Transaction Status Updated to: {$transaction->transaction_status} for Order ID: {$order_id}");

        // Send response to Midtrans
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notification Success'
            ]
        ]);
    }

    public function checkoutSuccess()
    {
        return view('frontend.checkout-success');
    }
}

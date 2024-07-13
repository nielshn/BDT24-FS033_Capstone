<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddToCartRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Fetch the user object instead of just the ID
        $cartItems = Cart::with(['product', 'product.user'])->where('users_id', $user->id)->get();
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        return view('frontend.cart', compact('cartItems', 'totalPrice', 'user'));
    }


    public function store(StoreAddToCartRequest $request)
    {
        $validated = $request->validated();

        $user = Auth::user();
        $product = Product::findOrFail($validated['products_id']);

        $cartItem = Cart::where('users_id', $user->id)->where('products_id', $validated['products_id'])->first();

        DB::transaction(function () use ($cartItem, $product, $validated) {
            if ($cartItem) {
                $cartItem->quantity += $validated['quantity'];
                $cartItem->save();
            } else {
                Cart::create([
                    'users_id' => Auth::id(),
                    'products_id' => $validated['products_id'],
                    'quantity' => $validated['quantity'],
                ]);
            }

            $product->stock -= $validated['quantity'];
            $product->save();
        });

        Session::flash('success', 'Product added to cart successfully.');
        return redirect()->route('cart-products.index');
    }

    public function updateQuantity(Request $request, $id)
    {
        $cartItem = Cart::with('product')->where('id', $id)->where('users_id', Auth::id())->firstOrFail();
        $newQuantity = $request->quantity;

        if ($newQuantity <= $cartItem->product->stock) {
            $cartItem->quantity = $newQuantity;
            $cartItem->save();

            $totalPrice = $cartItem->product->price * $cartItem->quantity;

            return response()->json(['success' => true, 'newTotalPrice' => $totalPrice]);
        }

        return response()->json(['success' => false, 'message' => 'Not enough stock available.']);
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $cartItem = Cart::findOrFail($id);
            $cartItem->delete();
            Session::flash('success', 'Product removed from cart successfully.');
        });

        return response()->json(['success' => true]);
    }

    public function checkoutSuccess()
    {
        return view('frontend.checkout-success');
    }
    // public function checkout(Request $request)
    // {
    //     $user = Auth::user();
    //     $cartItems = Cart::with('product')->where('users_id', $user->id)->get();

    //     DB::transaction(function () use ($cartItems) {
    //         foreach ($cartItems as $cartItem) {
    //             $product = $cartItem->product;
    //             if ($product->stock < $cartItem->quantity) {
    //                 throw new \Exception('Product stock is insufficient.');
    //             }

    //             $product->stock -= $cartItem->quantity;
    //             $product->save();

    //             $cartItem->delete();
    //         }
    //     });

    //     Session::flash('success', 'Checkout successful.');
    //     return redirect()->route('cart-products.index');
    // }
}

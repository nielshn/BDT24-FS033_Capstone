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
        $user = Auth::user();
        $cartItems = Cart::with(['product.productGaleries', 'product.user'])
            ->where('users_id', $user->id)
            ->get();

        // $totalPrice = $cartItems->sum(function ($cart) {
        //     return $cart->product->price * $cart->quantity;
        // });

        $totalPrice = 0;
        foreach ($cartItems as $cart) {
            $totalPrice += $cart->quantity * $cart->product->price;
        }

        return view('frontend.cart', compact('cartItems', 'user', 'totalPrice'));
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

    // public function update(Request $request, $id)
    // {
    //     $cart = Cart::findOrFail($id);
    //     $cart->quantity = $request->quantity;
    //     $cart->save();

    //     $totalPrice = Cart::where('users_id', Auth::id())->sum(function ($cart) {
    //         return $cart->product->price * $cart->quantity;
    //     });

    //     return response()->json(['success' => true, 'totalPrice' => $totalPrice]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $cart = Cart::findOrFail($id);
    //     $oldQuantity = $cart->quantity; // Simpan kuantitas sebelumnya untuk perhitungan stok produk

    //     $cart->quantity = $request->quantity;
    //     $cart->save();

    //     // Perbarui stok produk hanya jika kuantitas berubah
    //     if ($cart->quantity !== $oldQuantity) {
    //         $product = $cart->product;
    //         $product->stock += $oldQuantity - $cart->quantity;
    //         $product->save();
    //     }

    //     // Hitung total harga setelah perubahan kuantitas
    //     $totalPrice = Cart::where('users_id', Auth::id())->sum(function ($cart) {
    //         return $cart->product->price * $cart->quantity;
    //     });

    //     return response()->json(['success' => true, 'totalPrice' => $totalPrice]);
    // }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $oldQuantity = $cart->quantity;

        $cart->quantity = $request->quantity;
        $cart->save();

        // Update product stock only if quantity has changed
        if ($cart->quantity !== $oldQuantity) {
            $product = $cart->product;
            $product->stock += $oldQuantity - $cart->quantity;
            $product->save();
        }

        return response()->json(['success' => true, 'quantity' => $cart->quantity]);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $cart = Cart::findOrFail($id);
            $cart->delete();
        });

        return redirect()->route('cart-products.index');
    }

}

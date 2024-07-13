<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first();

        $productIds = Product::where('users_id', $user->id)->pluck('id');
        $transactionIds = Transaction::where('users_id', $user->id)->pluck('id');

        $transactions = [];
        $sellTransactions = [];
        $buyTransactions = [];

        if ($role === 'admin') {
            $transactions = TransactionDetail::with(['transaction.user', 'product.productGaleries'])
                ->orderByDesc('id')->paginate(5);
        } elseif ($role === 'seller') {
            $sellTransactions = TransactionDetail::with(['transaction.user', 'product.productGaleries'])
                ->whereIn('products_id', $productIds)
                ->orderByDesc('id')->paginate(5);

            $buyTransactions = TransactionDetail::with(['transaction.user', 'product.productGaleries'])
                ->whereIn('transactions_id', $transactionIds)
                ->orderByDesc('id')->paginate(5);
        } elseif ($role === 'customer') {
            $transactions = TransactionDetail::with(['transaction.user', 'product.productGaleries'])
                ->whereHas('transaction',function($query) use($user){
                    $query->where('users_id', $user->id);
                })
                ->orderByDesc('id')
                ->paginate(5);
        }

        return view('frontend.transactions.index', compact('sellTransactions', 'buyTransactions', 'transactions', 'role'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load(['details.product.productGaleries', 'user', 'details.product']);
        return view('frontend.transactions.show', compact('transaction'));
    }
}

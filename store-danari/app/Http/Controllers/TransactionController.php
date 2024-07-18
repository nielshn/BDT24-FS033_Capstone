<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
                ->whereHas('transaction', function ($query) use ($user) {
                    $query->where('users_id', $user->id);
                })
                ->orderByDesc('id')
                ->paginate(5);
        }

        return view('frontend.transactions.index', compact('sellTransactions', 'buyTransactions', 'transactions', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, Transaction $transaction)
    {
        $user = Auth::user();

        // Check if the user is a seller and owns the product in the transaction
        $transactionDetail = $transaction->details->first();
        if ($user->hasRole('seller') && $transactionDetail && $transactionDetail->product->users_id == $user->id) {
            $data = $request->validate([
                'shipping_status' => 'required|string',
                'resi' => 'nullable|string',
            ]);

            try {
                DB::beginTransaction();

                $transactionDetail->update($data);

                DB::commit();

                return redirect()->route('transactions.show', ['transaction' => $transaction->id])
                    ->with('success', 'Shipping status and Resi updated successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                Session::flash('error', 'Error updating transaction: ' . $e->getMessage());
                return back();
            }
        } else {
            return back()->withErrors('Unauthorized action.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load(['details.product.productGaleries', 'user', 'user.address']);
        return view('frontend.transactions.show', compact('transaction'));
    }
}

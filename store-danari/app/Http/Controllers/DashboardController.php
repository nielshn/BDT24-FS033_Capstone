<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAddressRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransactionDetail;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first();
        $transactions = [];
        $revenue = 0;
        $customerCount = 0;
        $recentTransactions = [];

        if ($role === 'admin') {
            // For admin role
            $transactions = TransactionDetail::with(['transaction.user', 'product.productGaleries'])
                ->orderByDesc('id');

            $revenue = TransactionDetail::sum('price');

            $customerCount = User::role(['customer', 'seller'])->count();

            $recentTransactions = $transactions->paginate(5);
        } elseif ($role === 'seller') {
            // For seller role
            $products = Product::where('users_id', $user->id)->pluck('id');

            $transactions = TransactionDetail::with(['transaction.user', 'product.productGaleries'])
                ->whereIn('products_id', $products)
                ->orderByDesc('id');

            $revenue = TransactionDetail::whereIn('products_id', $products)
                ->sum('price');

            $customerCount = User::whereHas('transactions.details.product', function ($query) {
                $query->where('users_id', Auth::id());
            })->count();

            $recentTransactions = $transactions->paginate(5);
        } elseif ($role === 'customer') {
            // For customer role
            $transactions = TransactionDetail::with(['transaction.user', 'product.productGaleries'])
                ->whereHas('transaction', function ($query) use ($user) {
                    $query->where('users_id', $user->id);
                })
                ->orderByDesc('id');


            $revenue = $transactions->sum('price');

            $customerCount = $transactions->count();
            $recentTransactions = $transactions->paginate(5);
        }

        return view('dashboard', compact('transactions', 'revenue', 'customerCount', 'recentTransactions'));
    }


    public function allProducts(Request $request)
    {
        $search = $request->input('search');
        $query = Product::with(['user', 'category', 'productGaleries']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('category', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $products = $query->orderByDesc('id')->paginate(5);

        if ($request->ajax()) {
            $html = view('backend.products.partials._products-table', compact('products'))->render();

            return response()->json([
                'html' => $html,
            ]);
        }

        return view('backend.products.index', compact('products'));
    }


    public function showProduct(Product $product)
    {
        $product->load(['user', 'category', 'productGaleries']);

        return view('backend.products.show', compact('product'));
    }

    public function allUsers(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with('roles')->select('users.*')->orderByDesc('id');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('role', function ($user) {
                    $roles = $user->roles->pluck('name')->map(function ($role) {
                        return "<strong>{$role}</strong>";
                    })->join(', ');
                    return $roles;
                })
                // Uncomment this if you have action buttons
                // ->addColumn('action', function ($user) {
                //     return view('backend.users.partials._action', compact('user'))->render();
                // })
                ->rawColumns(['role'])
                ->make(true);
        }

        return view('backend.users.index');
    }
}

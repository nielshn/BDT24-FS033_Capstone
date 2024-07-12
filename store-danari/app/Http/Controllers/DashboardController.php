<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAddressRequest;
use App\Http\Requests\UpdateStoreSettingsRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
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

    public function accountSettings()
    {
        $user = Auth::user();
        $address = $user->address;
        return view('auth.account-settings', compact('user', 'address'));
    }

    public function accountSettingsUpdate(UpdateAddressRequest $request)
    {
        $user = Auth::user();
        $address = $user->address;

        DB::transaction(function () use ($address, $request) {
            $validated = $request->validated();
            $address->update($validated);
        });
        return redirect()->route('account.settings', compact('user', 'address'))->with(['success' => 'Account settings updated successfully.']);
    }
}

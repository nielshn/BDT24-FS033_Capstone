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
        $query = Product::with(['user', 'productGaleries', 'category']);

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

        $products = $query->orderByDesc('id')->paginate(10);
        return view('backend.products.index', compact('products'));
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

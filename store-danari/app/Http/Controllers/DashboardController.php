<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAddressRequest;
use App\Http\Requests\UpdateStoreSettingsRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function storeSettings()
    {
        $user = Auth::user();
        if (!$user->hasRole('seller')) {
            abort(403, 'Unauthorized action.');
        }

        $store = $user->store;
        $category = $store->where('user_id', $user->id)->get();
        return view('frontend.store-settings', compact('category', 'store'));
    }

    public function storeSettingsUpdate(UpdateStoreSettingsRequest $request)
    {
        $user = Auth::user();
        if (!$user->hasRole('seller')) {
            abort(403, 'Unauthorized action.');
        }

        DB::transaction(function () use ($user, $request) {
            $validated = $request->validated();
            $store = $user->store;
            $store->update($validated);
        });

        return redirect()->route('store.settings')->with(['success' => 'Store settings updated successfully.']);
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

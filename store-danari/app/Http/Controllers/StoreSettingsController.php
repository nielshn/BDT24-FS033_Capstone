<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStoreSettingsRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StoreSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user->hasRole('seller')) {
            return redirect()->route('dashboard');
        }

        $store = $user->store;

        // Ambil kategori yang terkait dengan toko pengguna
        $categories = Category::whereHas('stores', function ($query) use ($store) {
            $query->where('id', $store->id);
        })->get();

        return view('frontend.store-settings', compact('store', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreSettingsRequest $request, $id)
    {
        $user = Auth::user();
        $store = $user->store;

        DB::transaction(function () use ($store, $request) {
            $validated = $request->validated();
            $store->update([
                'name' => $validated['store_name'],
                'categories_id' => $validated['categories_id'],
                'status' => $validated['is_store_open'],
            ]);
        });

        Session::flash('success', 'Store settings updated successfully.');
        return redirect()->route('store-settings.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use App\Http\Requests\UpdateAddressRequest;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $address = $user->address ?? new Address();
        return view('auth.account-settings', compact('user', 'address'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateAddressRequest $request)
    {
        $user = Auth::user();
        $address = $user->address ?? new Address();

        DB::transaction(function () use ($user, $address, $request) {
            $validated = $request->validated();
            $address->fill($validated);
            $address->user_id = $user->id;
            $address->save();
            $user->update(['phone_number' => $request->phone_number]); // Update phone number
        });

        return redirect()->route('account-settings.index')->with('success', 'Account Settings successfully updated.');
    }
}

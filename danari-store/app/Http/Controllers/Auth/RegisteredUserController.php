<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
            'is_store_open' => ['required'],
            'store_name' => ['nullable', 'required_if:is_store_open,true', 'string', 'max:255'],
            'categories_id' => ['nullable', 'required_if:is_store_open,true', 'integer', 'exists:categories,id'],
        ]);

        // process upload file photo request
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = 'images/user-icon.png';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
            'store_name' => $request->store_name,
            'categories_id' => $request->categories_id,
            'store_status' => $request->is_store_open === 'true' ? 1 : 0,
        ]);

        // Assign role based on store status
        if ($request->is_store_open === 'true') {
            $user->assignRole('seller');
        } else {
            $user->assignRole('customer');
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
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

    public function create(): View
    {
        $categories = Category::orderByDesc('id')->get();
        return view('auth.register', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'is_store_open' => ['required'],
            'store_name' => ['nullable', 'required_if:is_store_open,true', 'string', 'max:255'],
            'categories_id' => ['nullable', 'required_if:is_store_open,true', 'integer', 'exists:categories,id'],
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = 'images/default_avatar.png';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
        ]);

        if ($request->is_store_open === 'true') {
            Store::create([
                'user_id' => $user->id,
                'name' => $request->store_name,
                'categories_id' => $request->categories_id,
                'status' => true
            ]);

            $user->assignRole('seller');
        } else {
            $user->assignRole('customer');
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('front.registerSuccess');
    }

    public function check(Request $request)
    {
        return  User::where('email', $request->email)->count() > 0 ? 'Unvailable' : 'Available';
    }

    // Register Success VIew
    public function registerSuccess()
    {
        return view('auth.register-success');
    }
}

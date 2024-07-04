<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function storeSettings()
    {
        $categories = Category::orderByDesc('id')->get();
        return view('frontend.store-settings', compact('categories'));
    }

    public function accountSettings()
    {
        return view('auth.account-settings');
    }
}

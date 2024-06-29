<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function storeSettings()
    {
        return view('frontend.store-settings');
    }

    public function accountSettings(){
        return view('auth.account-settings');
    }
}

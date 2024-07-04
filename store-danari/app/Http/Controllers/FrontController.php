<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }


    public function category()
    {
        return view('frontend.category');
    }

    public function details()
    {
        return view('frontend.details');
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function success()
    {
        return view('frontend.success');
    }

    public function registerSuccess()
    {
        return view('auth.register-success');
    }
}

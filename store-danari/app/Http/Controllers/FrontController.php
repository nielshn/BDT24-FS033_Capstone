<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::orderByDesc('id')->get();
        $products = Product::with(['category', 'user', 'productGaleries'])->orderByDesc('id')->paginate(12);
        return view('frontend.home', compact('categories', 'products'));
    }

    public function category(Category $category, Request $request)
    {
        $search = $request->input('search');
        $query = $category->products()->with(['category', 'user', 'productGaleries'])->orderByDesc('id');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%');
            });
        }

        $products = $query->paginate(12);
        return view('frontend.category', compact('category', 'products'));
    }

    public function details($slug)
    {
        $product = Product::with(['category', 'user', 'productGaleries'])->where('slug', $slug)->firstOrFail();
        return view('frontend.details', compact('product'));
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

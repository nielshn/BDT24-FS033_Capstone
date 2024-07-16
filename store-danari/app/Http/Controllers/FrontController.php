<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    // Home Page
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::orderByDesc('id')->get();

        $query = Product::with(['category', 'user', 'productGaleries'])->orderByDesc('id');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $products = $query->paginate(12);

        if ($request->ajax()) {
            return view('frontend.partials.products', compact('products'))->render();
        }

        return view('frontend.home', compact('categories', 'products'));
    }

    public function detailCategory(Category $category, Request $request)
    {
        $search = $request->input('search');
        $query = $category->products()->with(['category', 'user', 'productGaleries'])->orderByDesc('id');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%');
            });
        }
        $categories = Category::orderByDesc('id')->get();
        $products = $query->paginate(4);
        return view('frontend.category', compact('category', 'products', 'categories'));
    }

    // All Products Page
    public function allProducts(Request $request)
    {
        $categories = Category::all();
        $search = $request->input('search');

        $query = Product::with(['category', 'user', 'productGaleries'])->orderByDesc('id');

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


        $products = $query->paginate(12);

        if ($request->ajax()) {
            return view('frontend.partials.products', compact('products'))->render();
        }

        return view('frontend.all-products', compact('products', 'categories'));
    }


    // Detail Product Page
    public function detailProducts($slug)
    {
        $product = Product::with(['category', 'user', 'productGaleries'])->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::with(['productGaleries'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(12)
            ->get();
        return view('frontend.details', compact('product', 'relatedProducts'));
    }
}

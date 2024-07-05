<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('users_id', Auth::id())->get();
        return view('frontend.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('frontend.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);
        $validated['users_id'] = Auth::id();

        DB::transaction(function () use ($validated, $request) {
            $product = Product::create($validated);

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $fileName = time() . '_' . $photo->getClientOriginalName();
                    $filePath = $photo->storeAs('productGalery', $fileName, 'public');

                    $product->productGaleries()->create([
                        'photos' => $filePath,
                    ]);
                }
            }
        });

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('frontend.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('frontend.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {

        DB::transaction(function () use ($request, $product) {
            $validated = $request->validated();
            $product->update($validated);

            if ($request->hasFile('photos')) {
                foreach ($product->productGaleries as $gallery) {
                    Storage::disk('public')->delete($gallery->photos);
                    $gallery->delete();
                }

                foreach ($request->file('photos') as $photo) {
                    $fileName = time() . '_' . $photo->getClientOriginalName();
                    $filePath = $photo->storeAs('productGalery', $fileName, 'public');

                    $product->productGaleries()->create([
                        'photos' => $filePath,
                    ]);
                }
            }
        });

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            foreach ($product->productGaleries as $gallery) {
                Storage::disk('public')->delete($gallery->photos);
                $gallery->delete();
            }

            $product->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('products.index')->with('error', 'Failed to delete product.');
        }

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

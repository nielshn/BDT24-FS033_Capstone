<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductGaleryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGalery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductGaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    // public function store(StoreProductGaleryRequest $request)
    // {
    //     $user = Auth::user();
    //     if (!$user->hasRole('seller')) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     DB::transaction(function () use ($request) {
    //         $validated = $request->validated();
    //         $photos = [];

    //         if ($request->hasFile('photos')) {
    //             foreach ($request->file('photos') as $photo) {
    //                 $fileName = time() . '_' . $photo->getClientOriginalName();
    //                 $filePath = $photo->storeAs('productGalery', $fileName, 'public');

    //                 $photos[] = [
    //                     'products_id' => $validated['products_id'],
    //                     'photos' => $filePath,
    //                 ];
    //             }
    //         }

    //         ProductGalery::insert($photos);
    //     });

    //     return redirect()->route('products.edit', $request->products_id)->with('success', 'Photos added successfully.');
    // }

    public function store(StoreProductGaleryRequest $request)
    {
        $validated = $request->validated();
        $photos = [];

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $fileName = time() . '_' . $photo->getClientOriginalName();
                $filePath = $photo->storeAs('productGalery', $fileName, 'public');

                $photos[] = [
                    'products_id' => $validated['products_id'],
                    'photos' => $filePath,
                ];
            }
        }

        ProductGalery::insert($photos);

        return redirect()->route('products.edit', $request->products_id)->with('success', 'Photos added successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductGalery $productGalery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductGalery $productGalery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductGalery $productGalery)
    {
        DB::beginTransaction();
        try {
            if (Storage::disk('public')->exists($productGalery->photos)) {
                Storage::disk('public')->delete($productGalery->photos);
            }
            $productId = $productGalery->products_id;
            $productGalery->delete();
            DB::commit();
            return redirect()->route('products.edit', $productId)->with('success', 'Photo deleted successfully.');
        } catch (\Throwable $e) {
            $productId = $productGalery->products_id;
            DB::rollBack();
            return redirect()->route('products.edit', $productId)->with('error', 'Failed to delete photo.');
        }
    }
}

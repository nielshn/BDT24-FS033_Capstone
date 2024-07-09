<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $successMessage = Session::get('success');
        $errorMessage = Session::get('error');

        if ($request->ajax()) {
            $data = Category::query()->orderByDesc('id');
            return DataTables::of($data)
                ->addColumn('action', function ($category) {
                    return view('backend.categories._action', compact('category'))->render();
                })
                ->editColumn('icon', function ($category) {
                    return $category->icon ? '<img src="' . Storage::url($category->icon) . '" style="max-height: 40px;"/>' : '';
                })
                ->rawColumns(['action', 'icon', 'index_no'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('backend.categories.index', compact('successMessage', 'errorMessage'));
    }


    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        // Check if a category with the same name (case-insensitive) exists, including soft deleted ones
        $existingCategory = Category::withTrashed()->where('name', $validated['name'])->first();

        if ($existingCategory) {
            if ($existingCategory->trashed()) {
                $existingCategory->restore();
                Session::flash('success', 'Previous category with the same name has been restored.');
                return redirect()->route('admin.categories.index');
            } else {
                Session::flash('error', 'Category with the same name already exists.');
                return redirect()->back();
            }
        }

        DB::transaction(function () use ($request, $validated) {
            if ($request->hasFile('icon')) {
                $validated['icon'] = $request->file('icon')->store('icons', 'public');
            } else {
                $validated['icon'] = 'images/icon-default.png';
            }

            $validated['slug'] = Str::slug($validated['name']);
            Category::create($validated);
        });

        Session::flash('success', 'Category has been created successfully');
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        DB::transaction(function () use ($request, $category) {
            $validated = $request->validated();

            if ($request->hasFile('icon')) {
                if ($category->icon && Storage::exists($category->icon)) {
                    Storage::delete($category->icon);
                }
                $validated['icon'] = $request->file('icon')->store('icons', 'public');
            }

            $validated['slug'] = Str::slug($validated['name']);
            $category->update($validated);
        });
        Session::flash('success', 'Category has been updated successfully');
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        try {
            DB::transaction(function () use ($category) {
                if ($category->icon && Storage::exists($category->icon)) {
                    Storage::disk('public')->delete($category->icon);
                }
                $category->delete();
            });
            Session::flash('success', 'Category has been deleted successfully');
            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Failed to delete category, please try again later');
            return redirect()->route('admin.categories.index');
        }
    }
}

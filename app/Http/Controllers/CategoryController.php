<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $categories = $user->shop->categories()->paginate(10);
        return view('pages.shop_owner.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.shop_owner.category.create', ['category' => new Category()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = auth()->user()->shop->categories()->create($request->validated());
        if (!$category) {
            Swal::error([
                'title' => 'Error',
                'text' => 'Category failed to create.'
            ]);
        }
        Swal::success([
            'title' => 'Success',
            'text' => 'Category created successfully.'
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('pages.shop_owner.category.create', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryStoreRequest $request, Category $category)
    {
        $category->update($request->validated());
        if (!$category) {
            Swal::error([
                'title' => 'Error',
                'text' => 'Category failed to update.'
            ]);
        }
        Swal::success([
            'title' => 'Success',
            'text' => 'Category updated successfully.'
        ]);
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        if(!$category->delete()){
            Swal::error([
                'title' => 'Error',
                'text' => 'Category failed to delete.'
            ]);
        }
        Swal::success([
            'title' => 'Success',
            'text' => 'Category deleted successfully.'
        ]);
        return redirect()->back();
    }
}

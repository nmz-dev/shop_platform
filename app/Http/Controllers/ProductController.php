<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class ProductController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $shop = $user->shop;
        $products = $shop->products()->with(['category'])->paginate(10);
        return view('pages.shop_owner.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

    // Pass a new empty product instance so the form works the same as edit
    return view('pages.shop_owner.product.create', [
        'product' => new Product(),
        'categories' => $categories,
    ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $shop = auth()->user()->shop;

        $data = $request->validated();

        if ($request->hasFile('pics')) {
            $data['pics'] = $request->file('pics')->store('product_pics', 'public');
        }

        $product = $shop->products()->create($data);

        if (!$product) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function show(Product $product)
    {
        //return view('pages.shop_owner.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('pages.shop_owner.product.edit', compact('product', 'categories'));
    }

    public function update(ProductStoreRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('pics')) {
            $data['pics'] = $request->file('pics')->store('product_pics', 'public');
        }

        $isUpdated = $product->update($data);

        if (!$isUpdated) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if (!$product->delete()) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}

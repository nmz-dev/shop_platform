<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopStoreRequest;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shop = auth()->user()->shop;
        return view('pages.shop_owner.shop.index', ['shop' => $shop]);
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
    public function store(ShopStoreRequest $request)
    {
        $fileName = null;
        if ($request->hasFile('profile_pic')) {
            $fileName = $this->storeShopIamge($request->file('profile_pic'), $request->name);
        }
        $data = [...$request->except('_token'), 'profile_pic' => $fileName ?? ""];
        $shop = auth()->user()->shop()->create($data);

        if ($shop)
            return redirect()->back()->with('success', 'Shop created successfully');
        else
            return redirect()->back()->with('error', 'Something went wrong');
    }

    /*
     * Store Shops profile picture into the public/shops folder
     */
    private function storeShopIamge($file, $shopName): string
    {
        // If request has a file then save the file and give the name to shop_name.extension and save in storage
        // Escape special characters and replace spaces with underscore
        $shopName = preg_replace('/\W+/', '', $shopName);

        $preservedFileName = $shopName . "." . $file->getClientOriginalExtension(); // shope_name.png
        // replace the request's file with the filename
        Storage::disk('public')->putFileAs('shops/' . $shopName, $file, $preservedFileName);
        return 'storage/shops/' . $shopName .'/'. $preservedFileName;
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $fileName = null;
        // If request has a file then save the file and give the name to shop_name.extension and save in storage
        if ($request->hasFile('profile_pic')) {
            $fileName = $this->storeShopIamge($request->file('profile_pic'), $request->name);
        }
        $data = [...$request->except('_token', '_method'), 'profile_pic' => $fileName ?? ""];
        auth()->user()->shop()->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }
}

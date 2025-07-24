<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $shops = Shop::query();

        if ($search) {
            $shops->where(function ($q) use($search){
                $q->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        $result = $shops->paginate($request->limit ?? 10);

        return response()->json([
            'shops' => $result->items(),
            'total' => $result->total(),
            'page' => $result->currentPage(),
            'limit' => $result->perPage()
        ], 200);
    }

    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        return response()->json($shop, 200);
    }

    public function byUser($userId)
    {
        $shop = Shop::where('user_id', $userId)->firstOrFail();
        return response()->json($shop, 200);
    }
}

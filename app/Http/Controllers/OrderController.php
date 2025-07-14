<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; 

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->shop->orders()->paginate(10);
        return view('pages.shop_owner.order.index', compact('orders'));
    }

    public function reject(Order $order)
    {
        if ($order->status !== 'rejected') {
            $order->update(['status' => 'rejected']);
        }

        return redirect()->route('order.index')->with('success', 'Order rejected successfully.');
    }
}

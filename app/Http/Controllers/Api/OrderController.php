<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->where('user_id', auth()->id())->get();
        return response()->json($orders, 200);
    }

    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);

        // Check if the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($order, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'total_amount' => 'required|numeric',
            'shipping_address' => 'required|string',
            'billing_address' => 'required|string',
            'payment_method' => 'required|string',
            'shipping_method' => 'required|string',
            'order_details' => 'required|array',
            'order_details.*.product_id' => 'required|exists:products,id',
            'order_details.*.quantity' => 'required|integer|min:1',
            'order_details.*.price' => 'required|numeric',
            'order_details.*.total' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $order = new Order();
            $order->user_id = auth()->id();
            $order->shop_id = $request->shop_id;
            $order->order_number = Order::generateOrderNumber();
            $order->total_amount = $request->total_amount;
            $order->status = 'pending';
            $order->payment_status = 'pending';
            $order->shipping_address = $request->shipping_address;
            $order->billing_address = $request->billing_address;
            $order->payment_method = $request->payment_method;
            $order->shipping_method = $request->shipping_method;
            $order->save();

            foreach ($request->order_details as $detail) {
                $product = Product::findOrFail($detail['product_id']);

                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $detail['product_id'];
                $orderDetail->product_name = $product->name;
                $orderDetail->quantity = $detail['quantity'];
                $orderDetail->price = $detail['price'];
                $orderDetail->total = $detail['total'];
                $orderDetail->save();

                // Update product stock
                $product->stock -= $detail['quantity'];
                $product->save();
            }

            DB::commit();

            return response()->json(Order::with('items')->findOrFail($order->id), 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Check if the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Only allow updates if the order is in pending status
        if ($order->status !== 'pending') {
            return response()->json(['message' => 'Cannot update order that is not in pending status'], 400);
        }

        $request->validate([
            'shipping_address' => 'sometimes|string',
            'billing_address' => 'sometimes|string',
            'payment_method' => 'sometimes|string',
            'shipping_method' => 'sometimes|string',
        ]);

        $order->update($request->only([
            'shipping_address',
            'billing_address',
            'payment_method',
            'shipping_method',
        ]));

        return response()->json(Order::with('items')->findOrFail($id), 200);
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        // Check if the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Only allow cancellation if the order is in pending or processing status
        if (!in_array($order->status, ['pending', 'processing'])) {
            return response()->json(['message' => 'Cannot cancel order that is not in pending or processing status'], 400);
        }

        $order->status = 'cancelled';
        $order->save();

        return response()->json([
            'message' => 'Order cancelled successfully',
            'order' => [
                'id' => $order->id,
                'status' => $order->status,
                'updated_at' => $order->updated_at
            ]
        ], 200);
    }

    public function details($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Check if the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $details = OrderDetail::where('order_id', $orderId)->get();
        return response()->json($details, 200);
    }
}

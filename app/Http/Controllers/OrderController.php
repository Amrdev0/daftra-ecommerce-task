<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create the order
        $order = Order::create(); // Adjust if you have additional fields

        foreach ($request->products as $productData) {
            $product = Product::find($productData['product_id']);

            // Ensure sufficient stock
            if ($product->stock < $productData['quantity']) {
                return response()->json(['error' => 'Insufficient stock for product: ' . $product->name], 400);
            }

            // Create the order-product relationship
            $order->products()->attach($product->id, ['quantity' => $productData['quantity']]);
            // Decrease stock
            $product->decrement('stock', $productData['quantity']);
        }

        return response()->json(['message' => 'Order placed successfully!', 'order_id' => $order->id], 201);
    }

    public function show($id)
    {
        $order = Order::with('products')->findOrFail($id);
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

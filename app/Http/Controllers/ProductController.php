<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get search parameters from the query string
        $query = $request->input('query'); // Search by name
        $minPrice = $request->input('min_price'); // Minimum price
        $maxPrice = $request->input('max_price'); // Maximum price

        // Create a dynamic cache key based on the search parameters
        $cacheKey = 'products' . ($query ? "_query_{$query}" : '') . 
                                  ($minPrice ? "_min_{$minPrice}" : '') . 
                                  ($maxPrice ? "_max_{$maxPrice}" : '');

        // Cache the products with the search applied
        $products = Cache::remember($cacheKey, 60, function () use ($query, $minPrice, $maxPrice) {
            return Product::search($query, $minPrice, $maxPrice)->paginate(9);
        });

        // Return the paginated products as a JSON response
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
        ]);

        $product->update($validatedData);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

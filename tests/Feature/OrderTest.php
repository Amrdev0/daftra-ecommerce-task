<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;

class OrderTest extends TestCase
{
    use RefreshDatabase; // Rollback database after each test

    /** @test */
    public function it_can_place_an_order()
    {
        // Create a product to order
        $product = Product::create([
            'name' => 'Sample Product',
            'price' => 99.99,
            'stock' => 10,
        ]);

        $orderData = [
            'products' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                ],
            ],
        ];

        // Simulate placing an order
        $response = $this->postJson('/api/orders', $orderData); // Adjust the URL as needed

        // Check for a successful response
        $response->assertStatus(201);

        // Verify that the order is created in the database
        $this->assertDatabaseHas('orders', []);
        $this->assertDatabaseHas('order_product', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }
}

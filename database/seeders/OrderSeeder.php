<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create some orders with random products
        $products = Product::all(); // Fetch all products

        // Example: Creating 10 orders
        for ($i = 0; $i < 10; $i++) {
            $order = Order::create(); // Create an Order

            // Attach random products to the order
            $orderProducts = [];
            foreach ($products->random(rand(1, 5)) as $product) {
                $orderProducts[] = [
                    'product_id' => $product->id,
                    'quantity' => rand(1, 3), // Random quantity between 1 and 3
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert data into the pivot table
            $order->products()->attach($orderProducts);
        }
    }
}

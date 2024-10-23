<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase; // Rollback database after each test

    /** @test */
    public function it_can_create_a_product()
    {
        $productData = [
            'name' => 'Sample Product',
            'price' => 99.99,
            'stock' => 10,
        ];

        $product = Product::create($productData);

        $this->assertDatabaseHas('products', $productData);
    }
}

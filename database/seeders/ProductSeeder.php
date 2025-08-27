<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Laptop',
            'description' => 'High-performance laptop',
            'price' => 999.99,
            'stock' => 50,
            'image' => 'laptop.jpg',
        ]);

        Product::create([
            'name' => 'Smartphone',
            'description' => 'Latest smartphone',
            'price' => 699.99,
            'stock' => 100,
            'image' => 'smartphone.jpg',
        ]);

        Product::create([
            'name' => 'Headphones',
            'description' => 'Noise-cancelling headphones',
            'price' => 199.99,
            'stock' => 75,
            'image' => 'headphones.jpg',
        ]);

        Product::factory(20)->create();
    }
}

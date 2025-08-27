<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'user_id' => 1, // Make sure this user exists in your users table
                'total_amount' => 2500.75,
                'status' => 'pending',
                'shipping_address' => '123 Main Street, Hyderabad',
                'billing_address' => '123 Main Street, Hyderabad',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'total_amount' => 4999.99,
                'status' => 'processing',
                'shipping_address' => '45 Ali Plaza, Karachi',
                'billing_address' => '45 Ali Plaza, Karachi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'total_amount' => 1500.00,
                'status' => 'completed',
                'shipping_address' => '67 Mall Road, Lahore',
                'billing_address' => '67 Mall Road, Lahore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'id' => $i,

                'name' => fake()->name(),
                'phot' => '/dummy/' . fake()->randomNumber(5, true) . '.jpg',

                'description' => fake()->text(500),

                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Product::insert($data);
    }
}

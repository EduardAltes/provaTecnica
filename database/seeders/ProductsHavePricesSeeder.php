<?php
namespace Database\Seeders;

use App\Models\ProductsHavePrices;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsHavePricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        // Ensure we have products
        if ($products->isEmpty()) {
            $this->command->info('Please seed the products table first!');
            return;
        }

        // Attach photos to products
         foreach ($products as $product) {
            $numPhotos = rand(0, 3); // Generate a random number of photos between 0 and 3
            for ($i = 0; $i < $numPhotos; $i++) {
                ProductsHavePrices::factory()->create([
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}

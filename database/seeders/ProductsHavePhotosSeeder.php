<?php
// database/seeders/ProductsHavePhotosSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductsHavePhotos;

class ProductsHavePhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
                ProductsHavePhotos::factory()->create([
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}

<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsHaveCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $categories = Category::pluck('id')->all();

        // Ensure we have products and categories
        if ($products->isEmpty() || empty($categories)) {
            $this->command->info('Please seed the products and categories tables first!');
            return;
        }

        foreach ($products as $product) {
            $categoryId = $categories[array_rand($categories)]; // Select a random category ID
            $this->attachParentCategories($product, $categoryId);
        }
    }

    /**
     * Attach parent categories recursively.
     *
     * @param Product $product
     * @param int $category_id
     * @return void
     */
    private function attachParentCategories($product, $category_id)
    {
        $category = Category::find($category_id);
        if ($category) {
            $product->categories()->attach($category_id);
            if ($category->father_id) {
                $this->attachParentCategories($product, $category->father_id);
            }
        }
    }
}

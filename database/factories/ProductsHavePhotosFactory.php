<?php

// database/factories/ProductsHavePhotosFactory.php
namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;


class ProductsHavePhotosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $maxAttempts = 5;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            $imageUrl = $this->faker->imageUrl();
            $response = Http::get($imageUrl);

            if ($response->status() !== 504 && $response->successful()) {
                $imageContent = Http::get($imageUrl)->body();
                return [
                    'product_id' => Product::factory(),
                    'photo' => $imageContent,
                ];
            }
        }

            // Return null if no successful response after maxAttempts
        return null;
    }
}

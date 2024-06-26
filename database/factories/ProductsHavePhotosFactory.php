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
        
        return [
            'product_id' => Product::factory(),
            'photo' => file_get_contents($this->faker->imageUrl()),
        ];
        
    }
}

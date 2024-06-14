<?php

// database/factories/ProductsHaveCategoriesFactory.php
namespace Database\Factories;

use App\Models\Event;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsHaveCategoriesFactory extends Factory
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
            'event_id' => Event::factory(),
            'units' => $this->faker->numberBetween(1, 10),
        ];
    }
}

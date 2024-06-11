<?php
// database/factories/ProductsHavePricesFactory.php
namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsHavePricesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $endDate = $this->faker->dateTimeBetween($startDate, '+2 years');
        
        return [
            'product_id' => Product::factory(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'price' => $this->faker->randomFloat(2, 0, 1000), // Generates a random price between 0 and 1000 with 2 decimal places
        ];
    }
}

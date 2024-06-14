<?php
// database/factories/ProductsHavePricesFactory.php
namespace Database\Factories;

use App\Models\Event;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */


     protected $model = Event::class;

     /**
      * Define the model's default state.
      *
      * @return array
      */
     public function definition()
     {

         return [
             'date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
         ];
     }
}
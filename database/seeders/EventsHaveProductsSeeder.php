<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Event;

class EventsHaveProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = Product::all();
        $events = Event::pluck('id')->all();

        // Ensure we have products and events
        if ($products->isEmpty() || empty($events)) {
            $this->command->info('Please seed the products and events tables first!');
            return;
        }

        foreach ($products as $product) {
            $numEvents = rand(1, 3); // Generate a random number of events between 0 and 3
            for ($i = 0; $i < $numEvents; $i++) {

                $event_id = $events[array_rand($events)]; // Select a random event ID

                if (!$product->events()->where('event_id', $event_id)->exists()) {
                    $product->events()->attach($event_id);
                }
            }
        }
    }
}

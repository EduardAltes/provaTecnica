<?php
// database/seeders/DatabaseSeeder.php


use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\EventSeeder;

use Database\Seeders\EventsHaveProductsSeeder;
use Database\Seeders\ProductsHaveCategoriesSeeder;
use Database\Seeders\ProductsHavePhotosSeeder;
use Database\Seeders\ProductsHavePricesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            EventSeeder::class,
            
            EventsHaveProductsSeeder::class,
            ProductsHaveCategoriesSeeder::class,
            ProductsHavePhotosSeeder::class,
            ProductsHavePricesSeeder::class,
            
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the number of users you want to create
        $numberOfUsers = 10;

        // Use the User factory to create users
        User::factory()->count($numberOfUsers)->create();
    }
}


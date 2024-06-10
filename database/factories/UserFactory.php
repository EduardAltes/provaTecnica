<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition()
    {
        $username = $this->faker->unique()->userName;
        
        while (User::where('username', $username)->exists()) {
            $username = $this->faker->unique()->userName;
        }
        
        return [
            'username' => $username,
            'password' => bcrypt('password'),
        ];
    }
}

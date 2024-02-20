<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

         $user = User::create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => Hash::make(12345) #password of test user
         ]);

         for ($i= 1 ; $i <=5; $i++){
             Product::create([
                 'user_id' => $user->id,
                 'name' => $faker->sentence(3),
                 'description' => $faker->paragraph(3),
                 'stock' => $faker->numberBetween(1, 100),
                 'price' => $faker->randomFloat(2, 1, 1000),
             ]);
         }

    }
}

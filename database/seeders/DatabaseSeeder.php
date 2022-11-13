<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

       \App\Models\User::factory(100)->create();
       \App\Models\Restaurant::factory(100)->create();
       \App\Models\Order::factory(1000)->create();
       \App\Models\Menu::factory(100)->create();
       \App\Models\Meal::factory(1000)->create();
       \App\Models\ConfrimOrder::factory(100)->create();
       \App\Models\Category::factory(300)->create();
       \App\Models\Booking::factory(1000)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Category::factory(5)->create();
        Currency::factory(1)->create(); // please do not run Currency more than 1 time, all data uploaded on first run!!
        Product::factory(50)->create();
        User::factory(1)->create(); // default user added for Basic Auth


    }
}

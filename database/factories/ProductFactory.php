<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'image' => 'Images/default.jpg',
            'price' => (string)number_format(rand(230,4560),2),
            'currency_id' => Currency::all('id')->random(1)->first(),
            'category_id' => Category::all('id')->random(1)->first(),
        ];
    }
}

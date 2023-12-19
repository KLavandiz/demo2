<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $FakeData = ['Abbey','Aboriginal and Torres Strait Islander organization','Aboriginal art gallery','Abortion clinic','Abrasives supplier','Abundant Life church','Accountant','Accounting firm','Accounting school','Accounting software company'];
        return [
            'category_name'=>$this->faker->unique()->randomElement($FakeData)
        ];
    }
}

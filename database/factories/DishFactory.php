<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class DishFactory extends Factory
{
    public function definition(): array { return ['name' => fake()->unique()->words(2, true), 'price' => fake()->randomFloat(2, 60, 350), 'is_bestseller' => false]; }
}

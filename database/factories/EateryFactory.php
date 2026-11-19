<?php
namespace Database\Factories;
use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class EateryFactory extends Factory
{
    public function definition(): array { $name = fake()->unique()->company().' Kitchen'; return ['district_id' => District::inRandomOrder()->value('id'), 'name' => $name, 'slug' => Str::slug($name), 'address' => fake()->address(), 'price_range' => fake()->randomElement(['budget','mid','splurge']), 'specialty' => fake()->sentence(3), 'is_open' => true]; }
    public function closed(): static { return $this->state(fn () => ['is_open' => false]); }
}

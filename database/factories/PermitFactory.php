<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class PermitFactory extends Factory
{
    public function definition(): array { return ['permit_no' => 'DVO-2026-'.fake()->unique()->numerify('#####'), 'expires_on' => fake()->dateTimeBetween('-1 year', '+2 years')->format('Y-m-d')]; }
}

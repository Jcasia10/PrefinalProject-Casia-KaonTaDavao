<?php
namespace Database\Seeders;
use App\Models\Feature;
use Illuminate\Database\Seeder;
class FeatureSeeder extends Seeder { public function run(): void { foreach (['Suki ni Casia','Budget Meal','Halal','Open 24 Hours','Aircon','Family Friendly'] as $name) Feature::create(compact('name')); } }

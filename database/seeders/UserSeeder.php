<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder { public function run(): void { User::create(['name'=>'Julianne Marie Casia','email'=>'casia@kaonta.test','password'=>Hash::make('kaonta2026')]); User::create(['name'=>'Tita Casia','email'=>'tita.casia@kaonta.test','password'=>Hash::make('kaonta2026')]); User::factory(10)->create(); } }

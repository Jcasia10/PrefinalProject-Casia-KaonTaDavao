<?php
namespace Database\Seeders;
use App\Models\{Dish,District,Eatery,Feature,Permit};
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class EaterySeeder extends Seeder
{
    public function run(): void
    {
        $district = District::where('name','Poblacion')->firstOrFail();
        $eatery = Eatery::create(['district_id'=>$district->id,'name'=>'Carinderia ni Casia','slug'=>Str::slug('Carinderia ni Casia'),'address'=>'San Pedro St., Poblacion, Davao City','price_range'=>'budget','specialty'=>'Tinolang Manok','is_open'=>true]);
        $eatery->features()->sync(Feature::whereIn('name',['Suki ni Casia','Budget Meal'])->pluck('id'));
        $eatery->permit()->create(['permit_no'=>'DVO-2026-1013','expires_on'=>'2027-10-13']);
        foreach ([['Tinolang Manok',85,true],['Kinilaw na Tuna',120,false],['Durian Shake',75,false]] as [$name,$price,$best]) $eatery->dishes()->create(['name'=>$name,'price'=>$price,'is_bestseller'=>$best]);
        $factory = Eatery::factory()->count(11)->create();
        $closed = Eatery::factory()->closed()->count(3)->create();
        foreach ($factory->concat($closed) as $index => $other) {
            $permit = Permit::factory()->make()->toArray();
            if ($index === 0) {
                $permit['expires_on'] = '2025-01-01';
            }
            $other->permit()->create($permit);
            $other->dishes()->createMany(Dish::factory()->count(fake()->numberBetween(2,5))->make()->toArray());
            $other->features()->attach(Feature::inRandomOrder()->limit(fake()->numberBetween(1,3))->pluck('id'));
        }
    }
}

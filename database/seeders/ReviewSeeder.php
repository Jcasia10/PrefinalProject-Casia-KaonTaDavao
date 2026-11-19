<?php
namespace Database\Seeders;
use App\Models\{Eatery,Review,User};
use Illuminate\Database\Seeder;
class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $eatery = Eatery::where('slug','carinderia-ni-casia')->firstOrFail();
        $tita = User::where('email','tita.casia@kaonta.test')->firstOrFail();
        $eatery->reviews()->create(['user_id'=>$tita->id,'rating'=>5,'body'=>'Lami kaayo! Balik-balikan ni Tita Casia.']);
        $eatery->reviews()->create(['user_id'=>User::where('email','casia@kaonta.test')->value('id'),'rating'=>4,'body'=>'Friendly service and delicious food.']);
        $eatery->reviews()->create(['user_id'=>User::whereNotIn('id',[$tita->id])->inRandomOrder()->value('id'),'rating'=>5,'body'=>'A wonderful Davao comfort food experience.']);
        foreach (Eatery::where('is_open',true)->whereKeyNot($eatery->id)->get() as $open) {
            $reviews = Review::factory()->count(fake()->numberBetween(0,6))->make();
            $open->reviews()->createMany($reviews->map(fn ($review) => $review->only(['user_id','rating','body']))->all());
        }
    }
}

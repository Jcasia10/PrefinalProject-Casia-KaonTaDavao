<?php
namespace App\Http\Controllers;
use App\Models\{District,Eatery,Review};
class HomeController extends Controller
{
    public function __invoke()
    {
        $top = Eatery::with(['district', 'features'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->whereHas('reviews')
            ->orderByDesc('reviews_avg_rating')
            ->limit(3)
            ->get();

        return view('home', [
            'eateryCount' => Eatery::count(),
            'districtCount' => District::count(),
            'reviewCount' => Review::count(),
            'topEateries' => $top,
        ]);
    }
}

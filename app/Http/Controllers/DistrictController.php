<?php
namespace App\Http\Controllers;
use App\Models\District;
class DistrictController extends Controller
{
    public function index() { return view('districts.index', ['districts'=>District::withCount('eateries')->orderBy('name')->get()]); }
    public function show(District $district)
    {
        $district->load([
            'eateries.district',
            'eateries.features',
        ]);
        $district->eateries->loadAvg('reviews', 'rating');
        $district->eateries->loadCount('reviews');
        $district->loadCount('reviews');

        return view('districts.show', compact('district'));
    }
}

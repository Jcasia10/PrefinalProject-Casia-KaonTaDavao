<?php
namespace App\Http\Controllers;
use App\Http\Requests\{StoreEateryRequest,UpdateEateryRequest};
use App\Models\{District,Eatery,Feature};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class EateryController extends Controller
{
    public function index(Request $request) { $query=Eatery::with(['district','features'])->withAvg('reviews','rating')->withCount('reviews')->when($request->q,fn($q,$v)=>$q->where(fn($x)=>$x->where('name','like',"%$v%")->orWhere('specialty','like',"%$v%")))->when($request->district,fn($q,$v)=>$q->where('district_id',$v))->when($request->feature,fn($q,$v)=>$q->whereHas('features',fn($f)=>$f->where('name',$v)))->orderBy('name'); return view('eateries.index',['eateries'=>$query->paginate(6)->withQueryString(),'districts'=>District::orderBy('name')->get(),'features'=>Feature::orderBy('name')->get()]); }
    public function create() { return view('eateries.create',['districts'=>District::orderBy('name')->get(),'features'=>Feature::orderBy('name')->get()]); }
    public function store(StoreEateryRequest $request) { $data=$request->validated(); $data['is_open']=(bool)($data['is_open']??false); $data['slug']=Str::slug($data['name']); $eatery=Eatery::create(collect($data)->except(['features','permit_no','expires_on'])->all()); $eatery->permit()->create(['permit_no'=>$data['permit_no'],'expires_on'=>$data['expires_on']]); $eatery->features()->sync($data['features']); return redirect()->route('eateries.show',$eatery)->with('success','Eatery added.'); }
    public function show(Eatery $eatery) { $eatery->load(['district','permit','dishes','features','reviews.user']); $users=\App\Models\User::orderBy('name')->get(); return view('eateries.show',compact('eatery','users')); }
    public function edit(Eatery $eatery) { $eatery->load(['permit','features']); return view('eateries.edit',['eatery'=>$eatery,'districts'=>District::orderBy('name')->get(),'features'=>Feature::orderBy('name')->get()]); }
    public function update(UpdateEateryRequest $request,Eatery $eatery) { $data=$request->validated(); $data['is_open']=(bool)($data['is_open']??false); $data['slug']=Str::slug($data['name']); $eatery->update(collect($data)->except(['features','permit_no','expires_on'])->all()); $eatery->permit()->updateOrCreate([],['permit_no'=>$data['permit_no'],'expires_on'=>$data['expires_on']]); $eatery->features()->sync($data['features']); return redirect()->route('eateries.show',$eatery)->with('success','Eatery updated.'); }
    public function destroy(Eatery $eatery) { $eatery->delete(); return redirect()->route('eateries.index')->with('success','Eatery deleted.'); }
}

@extends('layouts.app')
@section('content')
    <div class="mb-7">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#2f7d32]">Local guide</p>
        <h1 class="mt-1 font-serif text-4xl font-bold text-[#173d2a]">Eateries</h1>
    </div>
    <form class="mb-8 grid gap-3 rounded-2xl border border-[#d4dfd4] bg-white p-4 shadow-sm md:grid-cols-[1fr_0.8fr_0.8fr_auto]" method="GET" action="{{ route('eateries.index') }}">
        <label class="sr-only" for="eatery-search">Search</label>
        <input id="eatery-search" name="q" value="{{ old('q',request('q')) }}" placeholder="Search name or specialty" class="rounded-xl border border-[#ccd9cc] bg-[#f8fbf7] px-4 py-3 outline-none transition focus:border-[#2f7d32] focus:ring-2 focus:ring-[#2f7d32]/10">
        <label class="sr-only" for="district-filter">District</label>
        <select id="district-filter" name="district" class="rounded-xl border border-[#ccd9cc] bg-[#f8fbf7] px-4 py-3 outline-none transition focus:border-[#2f7d32]"><option value="">All districts</option>@foreach($districts as $district)<option value="{{ $district->id }}" @selected(request('district')==$district->id)>{{ $district->name }}</option>@endforeach</select>
        <label class="sr-only" for="feature-filter">Feature</label>
        <select id="feature-filter" name="feature" class="rounded-xl border border-[#ccd9cc] bg-[#f8fbf7] px-4 py-3 outline-none transition focus:border-[#2f7d32]"><option value="">All features</option>@foreach($features as $feature)<option @selected(request('feature')==$feature->name)>{{ $feature->name }}</option>@endforeach</select>
        <button class="rounded-xl bg-[#173d2a] px-5 py-3 font-bold text-white transition hover:bg-[#2f7d32]">Filter</button>
    </form>
    @if($eateries->isEmpty())
        <div class="rounded-2xl border border-dashed border-[#bccdbf] bg-white px-6 py-16 text-center">
            <p class="font-serif text-xl font-bold text-[#173d2a]">No eateries match your filters.</p>
        </div>
    @else
        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
        <div class="mt-8">{{ $eateries->links() }}</div>
    @endif
@endsection

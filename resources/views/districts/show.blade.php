@extends('layouts.app')
@section('content')
    <div class="mb-7 rounded-2xl border border-[#d4dfd4] bg-white px-6 py-6">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#2f7d32]">Davao district</p>
        <h1 class="mt-1 font-serif text-4xl font-bold text-[#173d2a]">{{ $district->name }}</h1>
        <p class="mt-2 text-[#64756a]">{{ $district->reviews_count }} {{ Str::plural('review',$district->reviews_count) }} in {{ $district->name }}</p>
    </div>
    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
        @foreach($district->eateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>
@endsection

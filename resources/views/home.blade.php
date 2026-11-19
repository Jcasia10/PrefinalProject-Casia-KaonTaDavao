@extends('layouts.app')
@section('content')
    <section class="relative mb-10 overflow-hidden rounded-[2rem] bg-[#173d2a] px-6 py-12 text-white sm:px-10 lg:px-14">
        <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-[#2f7d32]/30 blur-2xl"></div>
        <div class="absolute bottom-0 right-16 h-24 w-24 rounded-full border-[18px] border-[#a8c96a]/15"></div>
        <div class="relative max-w-2xl">
            <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-[#a8c96a]">Explore Davao's tables</p>
            <h1 class="font-serif text-4xl font-bold leading-tight sm:text-5xl">Find your next favorite <span class="text-[#66a866]">lutong Davao</span></h1>
            <p class="mt-5 max-w-xl text-base leading-7 text-[#dfd4c8]">Discover neighborhood carinderias, local specialties, and honest reviews across the city.</p>
            <a class="mt-7 inline-flex items-center gap-2 rounded-full bg-[#2f7d32] px-5 py-3 font-bold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-[#f06a35]" href="{{ route('eateries.index') }}">Browse eateries <span>→</span></a>
        </div>
    </section>

    <section class="mb-10 grid gap-4 md:grid-cols-3">
        @foreach([[$eateryCount,'Eateries','from every district'],[$districtCount,'Districts','to explore'],[$reviewCount,'Reviews','from the community']] as $stat)
            <div class="rounded-2xl border border-[#d4dfd4] bg-white px-5 py-5">
                <div class="flex items-end justify-between">
                    <div>
                        <b class="font-serif text-4xl text-[#173d2a]">{{ $stat[0] }}</b>
                        <p class="mt-1 font-bold text-[#2f7d32]">{{ $stat[1] }}</p>
                    </div>
                    <span class="text-sm text-[#829087]">{{ $stat[2] }}</span>
                </div>
            </div>
        @endforeach
    </section>

    <section>
        <div class="mb-5 flex items-end justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#2f7d32]">Community picks</p>
                <h2 class="mt-1 font-serif text-3xl font-bold text-[#173d2a]">Top Rated</h2>
            </div>
            <a class="text-sm font-bold text-[#2f7d32] hover:underline" href="{{ route('eateries.index') }}">View all →</a>
        </div>
        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($topEateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
    </section>
@endsection

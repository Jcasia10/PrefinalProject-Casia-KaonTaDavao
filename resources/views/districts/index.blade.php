@extends('layouts.app')
@section('content')
    <div class="mb-7">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#2f7d32]">The city guide</p>
        <h1 class="mt-1 font-serif text-4xl font-bold text-[#173d2a]">Districts</h1>
    </div>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($districts as $district)
            <a class="group rounded-2xl border border-[#d4dfd4] bg-white p-6 shadow-[0_10px_30px_rgba(76,55,35,0.05)] transition hover:-translate-y-1 hover:border-[#2f7d32]/40 hover:shadow-[0_14px_35px_rgba(76,55,35,0.10)]" href="{{ route('districts.show',$district) }}">
                <div class="flex items-end justify-between">
                    <div>
                        <b class="font-serif text-2xl text-[#173d2a] group-hover:text-[#2f7d32]">{{ $district->name }}</b>
                        <p class="mt-2 text-sm text-[#64756a]">{{ $district->eateries_count }} {{ Str::plural('eatery',$district->eateries_count) }}</p>
                    </div>
                    <span class="text-2xl text-[#bed0be] transition group-hover:translate-x-1 group-hover:text-[#2f7d32]">→</span>
                </div>
            </a>
        @endforeach
    </div>
@endsection

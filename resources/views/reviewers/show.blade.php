@extends('layouts.app')
@section('content')
    <div class="mb-7 rounded-2xl bg-[#173d2a] px-6 py-7 text-white">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-white">Community reviewer</p>
        <h1 class="mt-2 font-serif text-4xl font-bold">{{ $user->name }}</h1>
        <p class="mt-2 text-white">{{ $user->reviews->count() }} {{ Str::plural('review written',$user->reviews->count()) }}</p>
    </div>
    <div class="grid gap-4">
        @foreach($user->reviews as $review)
            <article class="rounded-2xl border border-[#d4dfd4] bg-white p-5 shadow-sm">
                <div class="mb-3 flex items-center justify-between">
                    <a class="font-serif text-xl font-bold text-[#173d2a] hover:text-[#2f7d32]" href="{{ route('eateries.show',$review->eatery) }}">{{ $review->eatery->name }}</a>
                    <x-rating :rating="$review->rating" />
                </div>
                <p class="leading-7 text-[#64756a]">{{ $review->body }}</p>
            </article>
        @endforeach
    </div>
@endsection

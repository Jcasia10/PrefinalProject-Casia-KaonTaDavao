@extends('layouts.app')
@section('content')
    <section class="overflow-hidden rounded-[2rem] border border-[#d4dfd4] bg-white">
        <div class="h-3 bg-gradient-to-r from-[#2f7d32] via-[#66a866] to-[#a8c96a]"></div>
        <div class="flex flex-col justify-between gap-6 px-6 py-7 sm:px-8 md:flex-row">
            <div>
                <div class="mb-3 flex items-center gap-2">
                    <span class="rounded-full bg-[#edf7ec] px-3 py-1 text-sm font-bold text-[#4f8f52]">{{ ['budget'=>'₱','mid'=>'₱₱','splurge'=>'₱₱₱'][$eatery->price_range] }}</span>
                    @unless($eatery->is_open)<span class="rounded-full bg-[#f4e4df] px-3 py-1 text-sm font-bold text-[#a33d2b]">Closed</span>@endunless
                </div>
                <h1 class="font-serif text-4xl font-bold text-[#173d2a]">{{ $eatery->name }}</h1>
                <p class="mt-3 text-[#64756a]">{{ $eatery->address }} · <a class="font-bold text-[#2f7d32] hover:underline" href="{{ route('districts.show',$eatery->district) }}">{{ $eatery->district->name }}</a></p>
                <div class="mt-5 flex flex-wrap gap-2">
                    @foreach($eatery->features as $feature)<span class="rounded-full border border-[#cfe0cf] bg-[#f3f8f1] px-3 py-1 text-sm font-semibold text-[#3d7044]">{{ $feature->name }}</span>@endforeach
                </div>
            </div>
            <div class="flex shrink-0 items-start gap-2">
                <a class="rounded-xl border border-[#ccd9cc] bg-white px-4 py-2.5 font-bold text-[#173d2a] transition hover:border-[#2f7d32] hover:text-[#2f7d32]" href="{{ route('eateries.edit',$eatery) }}">Edit</a>
                <form method="POST" action="{{ route('eateries.destroy',$eatery) }}" onsubmit="return confirm('Delete this eatery?')">
                    @csrf @method('DELETE')
                    <button class="rounded-xl bg-[#a33d2b] px-4 py-2.5 font-bold text-white transition hover:bg-[#7a3f2f]">Delete</button>
                </form>
            </div>
        </div>
    </section>

    <div class="mt-6 grid gap-5 md:grid-cols-2">
        <section class="rounded-2xl border border-[#d4dfd4] bg-white p-6">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#2f7d32]">Business permit</p>
            <h2 class="mt-2 font-serif text-2xl font-bold text-[#173d2a]">{{ $eatery->permit->permit_no }}</h2>
            <p class="mt-2 text-[#64756a]">Expires {{ $eatery->permit->expires_on->format('F d, Y') }}</p>
            @if($eatery->permit->expires_on->isPast())<p class="mt-3 inline-block rounded-full bg-[#f4e4df] px-3 py-1 font-bold text-[#a33d2b]">Permit expired</p>@endif
        </section>
        <section class="rounded-2xl border border-[#d4dfd4] bg-white p-6">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#2f7d32]">Menu highlights</p>
            <div class="mt-3 divide-y divide-[#eee5d8]">
                @foreach($eatery->dishes as $dish)
                    <div class="flex items-center justify-between gap-3 py-3"><span>{{ $dish->name }} @if($dish->is_bestseller)<b class="ml-1 text-xs text-[#4f8f52]">Bestseller</b>@endif</span><b class="text-[#173d2a]">₱{{ number_format($dish->price,2) }}</b></div>
                @endforeach
            </div>
        </section>
    </div>

    <div class="mt-10 grid gap-6 lg:grid-cols-[1fr_340px]">
        <section>
            <h2 class="mb-5 font-serif text-3xl font-bold text-[#173d2a]">Reviews</h2>
            @forelse($eatery->reviews->sortByDesc('created_at') as $review)
                <article class="mb-4 rounded-2xl border border-[#d4dfd4] bg-white p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <a class="font-bold text-[#173d2a] hover:text-[#2f7d32]" href="{{ route('reviewers.show',$review->user) }}">{{ $review->user->name }}</a>
                            <div class="mt-1"><x-rating :rating="$review->rating" /><span class="ml-2 text-xs text-[#829087]">{{ $review->created_at->format('M d, Y') }}</span></div>
                        </div>
                        <form method="POST" action="{{ route('reviews.destroy',$review) }}">@csrf @method('DELETE')<button class="text-sm font-semibold text-[#a33d2b] hover:underline">Delete</button></form>
                    </div>
                    <p class="mt-4 leading-7 text-[#64756a]">{{ $review->body }}</p>
                </article>
            @empty
                <p class="rounded-2xl border border-dashed border-[#bccdbf] bg-white p-8 text-center text-[#64756a]">No reviews yet.</p>
            @endforelse
        </section>
        @if($eatery->is_open)
            <aside class="h-fit rounded-2xl border border-[#d4dfd4] bg-[#173d2a] p-6 text-white">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-white">Share your experience</p>
                <h2 class="mt-2 font-serif text-2xl font-bold">Leave a review</h2>
                <form method="POST" action="{{ route('eateries.reviews.store',$eatery) }}" class="mt-5">
                    @csrf
                    @if($errors->any())<div class="mb-4 rounded-xl bg-red-100 p-3 text-sm text-red-700">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
                    <label class="block text-sm font-bold">Reviewer<select name="user_id" class="mt-2 w-full rounded-xl border border-[#9caf9f] px-3 py-2.5 text-[#173d2a] outline-none transition focus:border-[#2f7d32] focus:ring-2 focus:ring-[#2f7d32]/10"><option value="">Choose reviewer</option>@foreach($users as $user)<option value="{{ $user->id }}" @selected(old('user_id')==$user->id)>{{ $user->name }}</option>@endforeach</select></label>@error('user_id')<small class="mt-1 block text-[#ffb7a7]">{{ $message }}</small>@enderror
                    <label class="mt-4 block text-sm font-bold">Rating<input name="rating" type="number" min="1" max="5" value="{{ old('rating') }}" class="mt-2 w-full rounded-xl border border-[#9caf9f] px-3 py-2.5 text-[#173d2a] outline-none transition focus:border-[#2f7d32] focus:ring-2 focus:ring-[#2f7d32]/10" placeholder="1–5"></label>@error('rating')<small class="mt-1 block text-[#ffb7a7]">{{ $message }}</small>@enderror
                    <label class="mt-4 block text-sm font-bold">Review<textarea name="body" rows="4" class="mt-2 w-full rounded-xl border border-[#9caf9f] px-3 py-2.5 text-[#173d2a] outline-none transition focus:border-[#2f7d32] focus:ring-2 focus:ring-[#2f7d32]/10" placeholder="What did you enjoy?">{{ old('body') }}</textarea></label>@error('body')<small class="mt-1 block text-[#ffb7a7]">{{ $message }}</small>@enderror
                    <button class="mt-5 w-full rounded-xl bg-[#2f7d32] px-4 py-3 font-bold text-white shadow-sm transition duration-300 hover:-translate-y-0.5 hover:bg-[#173d2a] hover:shadow-lg">Post review</button>
                </form>
            </aside>
        @else
            <aside class="h-fit rounded-2xl border border-[#d4dfd4] bg-[#f4e4df] p-6 text-[#7d4033]">This eatery is closed. Reviews are paused.</aside>
        @endif
    </div>
@endsection

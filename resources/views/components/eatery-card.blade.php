<article class="group overflow-hidden rounded-2xl border border-[#d4dfd4] bg-white shadow-[0_12px_35px_rgba(76,55,35,0.06)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(76,55,35,0.12)]">
    <div class="h-2 bg-gradient-to-r from-[#2f7d32] via-[#66a866] to-[#a8c96a]"></div>
    <div class="p-5">
        <div class="mb-3 flex items-start justify-between gap-3">
            <h2 class="font-serif text-xl font-bold leading-tight text-[#173d2a]">
                <a class="transition group-hover:text-[#2f7d32]" href="{{ route('eateries.show',$eatery) }}">{{ $eatery->name }}</a>
            </h2>
            @unless($eatery->is_open)
                <span class="shrink-0 rounded-full bg-[#f4e4df] px-2.5 py-1 text-xs font-bold text-[#a33d2b]">Closed</span>
            @endunless
        </div>
        <a class="inline-flex items-center gap-1 text-sm font-semibold text-[#2f7d32] hover:underline" href="{{ route('districts.show',$eatery->district) }}">
            <span>{{ $eatery->district->name }}</span>
            <span aria-hidden="true">↗</span>
        </a>
        <p class="mt-3 min-h-12 text-sm leading-6 text-[#64756a]">{{ $eatery->specialty ?: 'Local Davao favorites' }}</p>
        <div class="mt-4 flex items-end justify-between border-t border-[#eee5d8] pt-4">
            <span class="rounded-lg bg-[#edf7ec] px-2.5 py-1 text-sm font-bold text-[#4f8f52]" title="Price range">{{ ['budget'=>'₱','mid'=>'₱₱','splurge'=>'₱₱₱'][$eatery->price_range] }}</span>
            @if(isset($eatery->reviews_count) && $eatery->reviews_count)
                <div class="text-right text-sm">
                    <x-rating :rating="$eatery->reviews_avg_rating" />
                    <span class="ml-1 text-[#8a8174]">({{ $eatery->reviews_count }} {{ Str::plural('review',$eatery->reviews_count) }})</span>
                </div>
            @else
                <span class="text-sm text-[#829087]">No reviews yet</span>
            @endif
        </div>
        <div class="mt-4 flex min-h-7 flex-wrap gap-1.5">
            @foreach($eatery->features as $feature)
                <a class="rounded-full border border-[#cfe0cf] bg-[#f3f8f1] px-2.5 py-1 text-xs font-semibold text-[#3d7044] transition hover:border-[#2f7d32] hover:text-[#2f7d32]" href="{{ route('eateries.index',['feature'=>$feature->name]) }}">{{ $feature->name }}</a>
            @endforeach
        </div>
    </div>
</article>

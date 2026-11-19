<header class="sticky top-0 z-30 border-b border-black/5 bg-[#f8fbf7]/95 backdrop-blur">
    <nav class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a class="flex items-center gap-3" href="{{ route('home') }}" aria-label="Kaon Ta! Davao – Casia's Food Guide">
            <span class="grid h-10 w-10 place-items-center rounded-full bg-[#2f7d32] text-lg text-white shadow-sm">K</span>
            <span>
                <span class="block font-serif text-lg font-bold leading-tight text-[#173d2a]">Kaon Ta! Davao</span>
                <span class="mt-1 block text-[9px] font-bold uppercase tracking-[0.18em] text-[#2f7d32]">Casia's Food Guide</span>
            </span>
        </a>
        <div class="flex items-center gap-1 text-sm font-semibold sm:gap-2">
            <a class="rounded-full px-3 py-2 text-[#526159] transition hover:bg-white hover:text-[#2f7d32]" href="{{ route('eateries.index') }}">Eateries</a>
            <a class="rounded-full px-3 py-2 text-[#526159] transition hover:bg-white hover:text-[#2f7d32]" href="{{ route('districts.index') }}">Districts</a>
            <a class="ml-1 rounded-full bg-[#173d2a] px-4 py-2.5 text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-[#2f7d32]" href="{{ route('eateries.create') }}">Add eatery</a>
        </div>
    </nav>
</header>

@if(session('success'))
    <div class="mb-6 flex items-center gap-3 rounded-2xl border border-[#cfe7ca] bg-[#eff8ec] px-5 py-4 text-sm font-semibold text-[#45733b] shadow-sm">
        <span class="grid h-7 w-7 place-items-center rounded-full bg-[#6aa261] text-white">✓</span>
        {{ session('success') }}
    </div>
@endif

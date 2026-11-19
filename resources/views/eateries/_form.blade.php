@if($errors->any())
    <div class="mb-6 rounded-2xl border border-[#efb8a9] bg-[#fff1ed] p-4 text-[#7d4033]">
        <b>Please fix these errors:</b>
        <ul class="mt-2 list-inside list-disc">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<div class="grid gap-5 md:grid-cols-2">
    <label class="text-sm font-bold text-[#173d2a]">Name
        <input name="name" value="{{ old('name',$eatery->name ?? '') }}" class="mt-2 w-full rounded-xl border border-[#ccd9cc] bg-[#f8fbf7] px-4 py-3 outline-none transition focus:border-[#2f7d32] focus:ring-2 focus:ring-[#2f7d32]/10">
        @error('name')<small class="mt-1 block font-normal text-[#b33d2a]">{{ $message }}</small>@enderror
    </label>
    <label class="text-sm font-bold text-[#173d2a]">District
        <select name="district_id" class="mt-2 w-full rounded-xl border border-[#9caf9f] bg-[#f8fbf7] px-4 py-3 outline-none transition focus:border-[#2f7d32] focus:ring-2 focus:ring-[#2f7d32]/10">
            @foreach($districts as $district)<option value="{{ $district->id }}" @selected(old('district_id',$eatery->district_id ?? '')==$district->id)>{{ $district->name }}</option>@endforeach
        </select>
        @error('district_id')<small class="mt-1 block font-normal text-[#b33d2a]">{{ $message }}</small>@enderror
    </label>
    <label class="text-sm font-bold text-[#173d2a] md:col-span-2">Address
        <input name="address" value="{{ old('address',$eatery->address ?? '') }}" class="mt-2 w-full rounded-xl border border-[#ccd9cc] bg-[#f8fbf7] px-4 py-3 outline-none transition focus:border-[#2f7d32]">
        @error('address')<small class="mt-1 block font-normal text-[#b33d2a]">{{ $message }}</small>@enderror
    </label>
    <label class="text-sm font-bold text-[#173d2a]">Price range
        <select name="price_range" class="mt-2 w-full rounded-xl border border-[#9caf9f] bg-[#f8fbf7] px-4 py-3 outline-none transition focus:border-[#2f7d32] focus:ring-2 focus:ring-[#2f7d32]/10">
            @foreach(['budget','mid','splurge'] as $range)<option @selected(old('price_range',$eatery->price_range ?? '')==$range) value="{{ $range }}">{{ $range }}</option>@endforeach
        </select>
        @error('price_range')<small class="mt-1 block font-normal text-[#b33d2a]">{{ $message }}</small>@enderror
    </label>
    <label class="text-sm font-bold text-[#173d2a]">Specialty
        <input name="specialty" value="{{ old('specialty',$eatery->specialty ?? '') }}" class="mt-2 w-full rounded-xl border border-[#ccd9cc] bg-[#f8fbf7] px-4 py-3 outline-none transition focus:border-[#2f7d32]">
        @error('specialty')<small class="mt-1 block font-normal text-[#b33d2a]">{{ $message }}</small>@enderror
    </label>
    <label class="text-sm font-bold text-[#173d2a]">Permit number
        <input name="permit_no" value="{{ old('permit_no',$eatery->permit->permit_no ?? '') }}" class="mt-2 w-full rounded-xl border border-[#ccd9cc] bg-[#f8fbf7] px-4 py-3 outline-none transition focus:border-[#2f7d32]">
        @error('permit_no')<small class="mt-1 block font-normal text-[#b33d2a]">{{ $message }}</small>@enderror
    </label>
    <label class="text-sm font-bold text-[#173d2a]">Permit expiry
        <input type="date" name="expires_on" value="{{ old('expires_on',isset($eatery) ? $eatery->permit?->expires_on?->format('Y-m-d') : '') }}" class="mt-2 w-full rounded-xl border border-[#ccd9cc] bg-[#f8fbf7] px-4 py-3 outline-none transition focus:border-[#2f7d32]">
        @error('expires_on')<small class="mt-1 block font-normal text-[#b33d2a]">{{ $message }}</small>@enderror
    </label>
</div>

<label class="mt-5 inline-flex items-center gap-3 rounded-xl border border-[#d4dfd4] bg-[#f8fbf7] px-4 py-3 text-sm font-bold text-[#173d2a]">
    <input type="hidden" name="is_open" value="0">
    <input type="checkbox" name="is_open" value="1" class="h-4 w-4 accent-[#2f7d32]" @checked(old('is_open',$eatery->is_open ?? true))>
    Open for customers
</label>
@error('is_open')<small class="mt-1 block text-[#b33d2a]">{{ $message }}</small>@enderror

<fieldset class="mt-6">
    <legend class="text-sm font-bold text-[#173d2a]">Features</legend>
    <div class="mt-3 flex flex-wrap gap-2">
        @foreach($features as $feature)
            <label class="cursor-pointer rounded-full border border-[#d4dfd4] bg-[#f8fbf7] px-3 py-2 text-sm text-[#64756a] has-[:checked]:border-[#2f7d32] has-[:checked]:bg-[#edf7ec] has-[:checked]:text-[#4f8f52]">
                <input type="checkbox" name="features[]" value="{{ $feature->id }}" class="mr-1 accent-[#2f7d32]" @checked(in_array($feature->id,old('features',isset($eatery)?$eatery->features->pluck('id')->all():[])))>
                {{ $feature->name }}
            </label>
        @endforeach
    </div>
    @error('features')<small class="mt-2 block text-[#b33d2a]">{{ $message }}</small>@enderror
    @error('features.*')<small class="mt-1 block text-[#b33d2a]">{{ $message }}</small>@enderror
</fieldset>

<button class="mt-7 rounded-xl bg-[#173d2a] px-6 py-3 font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-[#2f7d32]">{{ $buttonText }}</button>

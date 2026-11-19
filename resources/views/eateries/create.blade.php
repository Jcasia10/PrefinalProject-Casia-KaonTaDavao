@extends('layouts.app')
@section('content')
    <div class="mb-7">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#2f7d32]">Community listing</p>
        <h1 class="mt-1 font-serif text-4xl font-bold text-[#173d2a]">Add Eatery</h1>
    </div>
    <form method="POST" action="{{ route('eateries.store') }}" class="rounded-2xl border border-[#d4dfd4] bg-white p-5 shadow-[0_12px_35px_rgba(76,55,35,0.06)] sm:p-7">
        @csrf
        @include('eateries._form',['buttonText'=>'Add Eatery'])
    </form>
@endsection

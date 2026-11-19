<?php
namespace App\Http\Controllers;
use App\Models\User;
class ReviewerController extends Controller
{
    public function show(User $user) { $user->load(['reviews'=>fn($q)=>$q->latest()->with('eatery')]); return view('reviewers.show', compact('user')); }
}

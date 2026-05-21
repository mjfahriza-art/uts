<?php

use App\Http\Controllers\MemberController;
use App\Models\Gym;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'gyms' => Gym::withCount('members')->get(),
        'members' => Member::with('gym')->get(),
        'memberships' => Membership::with(['member', 'gym'])->latest()->get(),
    ]);
});

Route::resource('members', MemberController::class);

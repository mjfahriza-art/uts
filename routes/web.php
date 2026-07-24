<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TrainerController;
use App\Models\Gym;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'gyms' => Gym::withCount('members')->get(),
            'members' => Member::with('gym')->get(),
            'memberships' => Membership::with(['member', 'gym'])->latest()->get(),
        ]);
    });

    Route::resource('members', MemberController::class);
    Route::patch('members/{member}/toggle-status', [MemberController::class, 'toggleStatus'])->name('members.toggle-status');
    Route::resource('trainers', TrainerController::class);
});

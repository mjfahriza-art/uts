<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\TrainerController;
use App\Models\Trainer;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'trainers' => Trainer::withCount('members')->get(),
            'members' => Member::with('trainer')->get(),
            'memberships' => Membership::with(['member', 'trainer'])->latest()->get(),
        ]);
    })->name('dashboard');

    Route::resource('members', MemberController::class);
    Route::patch('members/{member}/toggle-status', [MemberController::class, 'toggleStatus'])->name('members.toggle-status');
    Route::resource('trainers', TrainerController::class);
    Route::resource('memberships', MembershipController::class);
});

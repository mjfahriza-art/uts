<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\TrainerController;
use App\Models\Trainer;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return redirect('/login');
});

// Menyajikan file storage (foto) langsung dari storage/app/public tanpa symlink.
// Pakai path /photo/ (bukan /storage/) agar tidak bentrok dengan folder fisik
// public/storage di shared hosting (mis. InfinityFree) yang melayani file statis.
Route::get('/photo/{path}', function (string $path) {
    $path = urldecode($path);

    // Cegah path traversal
    if (str_contains($path, '..')) {
        abort(404);
    }

    $fullPath = storage_path('app/public/' . $path);

    if (!File::exists($fullPath) || !is_file($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath);
})->where('path', '.*');

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
    Route::resource('trainers', TrainerController::class);
    Route::resource('memberships', MembershipController::class);
});

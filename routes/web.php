<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect('/login');
    } else {
        return redirect('/dashboard');
    }
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::prefix('admin')
            ->name('admin.')
            ->group(function () {
                Route::prefix('users')
                    ->name('users.')
                    ->group(function () {
                        Route::get('/', [UserController::class, 'index'])
                            ->name('index');
                    });
            });

        Route::prefix('client')
            ->name('client.')
            ->group(function () {});

        Route::prefix('employee')
            ->name('employee.')
            ->group(function () {});

        Route::prefix('vendor')
            ->name('vendor.')
            ->group(function () {});
    });

require __DIR__.'/auth.php';

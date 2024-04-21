<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DocumentCategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthCheckMiddleware;

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

Route::middleware(['auth', 'verified', 'lockCheck'])
    ->group(function () {
        Route::prefix('admin')
            ->name('admin.')
            ->group(function () {
                Route::prefix('document-categories')
                    ->name('document-categories.')
                    ->group(function () {
                        Route::get('/', [DocumentCategoryController::class, 'index'])
                            ->name('index');

                        Route::get('create', [DocumentCategoryController::class, 'create'])
                            ->name('create');

                        Route::get('edit/{id}', [DocumentCategoryController::class, 'edit'])
                            ->name('edit');
                    });
                Route::prefix('users')
                    ->name('users.')
                    ->group(function () {
                        Route::get('/', [UserController::class, 'index'])
                            ->name('index');

                        Route::get('create', [UserController::class, 'create'])
                            ->name('create');

                        Route::get('edit/{id}', [UserController::class, 'edit'])
                            ->name('edit');

                        Route::get('gates', [UserController::class, 'gates'])
                            ->name('gates');
                    });
            });

        Route::prefix('client')
            ->name('client.')
            ->group(function () {});

        Route::prefix('employee')
            ->name('employee.')
            ->group(function () {
                Route::prefix('companies')
                    ->name('companies.')
                    ->group(function () {
                        Route::get('/', [CompanyController::class, 'index'])
                            ->name('index');

                        Route::get('create', [CompanyController::class, 'create'])
                            ->name('create');

                        Route::get('edit/{id}', [CompanyController::class, 'edit'])
                            ->name('edit');
                    });

                Route::prefix('clients')
                    ->name('clients.')
                    ->group(function () {
                        Route::get('/', [ClientController::class, 'index'])
                            ->name('index');

                        Route::get('create', [ClientController::class, 'create'])
                            ->name('create');

                        Route::get('edit/{id}', [ClientController::class, 'edit'])
                            ->name('edit');
                    });
            });

        Route::prefix('vendor')
            ->name('vendor.')
            ->group(function () {});
    });

require __DIR__.'/auth.php';

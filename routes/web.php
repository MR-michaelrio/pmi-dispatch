<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AmbulanceController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\DispatchController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('home'))->name('home');

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('ambulances', AmbulanceController::class);
        Route::resource('drivers', DriverController::class);

        Route::get('dispatches', [DispatchController::class, 'index'])
            ->name('dispatches.index');

        Route::get('dispatches/create', [DispatchController::class, 'create'])
            ->name('dispatches.create');

        Route::post('dispatches', [DispatchController::class, 'store'])
            ->name('dispatches.store');

        Route::patch(
            'dispatches/{dispatch}/complete',
            [DispatchController::class, 'complete']
        )->name('dispatches.complete');
    });
});

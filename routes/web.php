<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AmbulanceController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\DispatchController;
use App\Http\Controllers\Admin\MapController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
})->name('home');

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| AUTHENTICATED
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Master Data
        Route::resource('ambulances', AmbulanceController::class);
        Route::resource('drivers', DriverController::class);

        // Dispatch
        Route::get('dispatches', [DispatchController::class, 'index'])
            ->name('dispatches.index');

        Route::get('dispatches/create', [DispatchController::class, 'create'])
            ->name('dispatches.create');

        Route::post('dispatches', [DispatchController::class, 'store'])
            ->name('dispatches.store');

        Route::post('dispatches/{dispatch}/next', [DispatchController::class, 'next'])
            ->name('dispatches.next');

        Route::delete('dispatches/{dispatch}', [DispatchController::class, 'destroy'])
            ->name('dispatches.destroy');

        // ✅ EXPORT PDF
        Route::get('dispatches/export/pdf', [DispatchController::class, 'exportPdf'])
            ->name('dispatches.export.pdf');

        // ✅ MAPS (INI YANG SEBELUMNYA HILANG)
        Route::get('maps', [MapController::class, 'index'])
            ->name('maps');
    });
});

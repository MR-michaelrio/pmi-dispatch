<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AmbulanceController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\DispatchController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\PatientRequestController as AdminPatientRequestController;
use App\Http\Controllers\PatientRequestController;
use App\Http\Controllers\Driver\DriverDashboardController;
use App\Http\Controllers\Api\DriverLocationController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
})->name('home');

// Public Patient Request Form
Route::get('/request', [PatientRequestController::class, 'create'])
    ->name('patient-request.create');
Route::post('/request', [PatientRequestController::class, 'store'])
    ->name('patient-request.store');

// API Routes (for driver GPS tracking)
Route::post('/api/driver/location', [DriverLocationController::class, 'updateLocation'])
    ->middleware('auth');

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| AUTHENTICATED
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        // Redirect based on role
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('driver.dashboard');
        }
    })->name('dashboard');

    // Driver Dashboard
    Route::get('/driver/dashboard', [DriverDashboardController::class, 'index'])
        ->name('driver.dashboard');

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
        Route::get('maps/ambulances', [MapController::class, 'getAmbulances'])
            ->name('maps.ambulances');

        // Patient Requests Management
        Route::get('patient-requests', [AdminPatientRequestController::class, 'index'])
            ->name('patient-requests.index');
        Route::get('patient-requests/{patientRequest}', [AdminPatientRequestController::class, 'show'])
            ->name('patient-requests.show');
        Route::get('patient-requests/{patientRequest}/dispatch', [AdminPatientRequestController::class, 'createDispatch'])
            ->name('patient-requests.create-dispatch');
        Route::post('patient-requests/{patientRequest}/reject', [AdminPatientRequestController::class, 'reject'])
            ->name('patient-requests.reject');
    });
});

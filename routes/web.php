<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'web.',
    'middleware' => ['auth'],
], function() {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Role
    Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role');
    Route::get('/role/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('role.show');
    Route::post('/role', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    Route::put('/role/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}', [App\Http\Controllers\RoleController::class, 'delete'])->name('role.delete');

    // User
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::post('/user', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');

    // Dokter Checkup
    Route::get('/dokter-checkup', [App\Http\Controllers\DokterCheckupController::class, 'index'])->name('dokter-checkup');
    Route::get('/dokter-checkup/{id}', [App\Http\Controllers\DokterCheckupController::class, 'show'])->name('dokter-checkup.show');
    Route::post('/dokter-checkup', [App\Http\Controllers\DokterCheckupController::class, 'store'])->name('dokter-checkup.store');
    Route::put('/dokter-checkup/{id}', [App\Http\Controllers\DokterCheckupController::class, 'update'])->name('dokter-checkup.update');
    Route::delete('/dokter-checkup/{id}', [App\Http\Controllers\DokterCheckupController::class, 'delete'])->name('dokter-checkup.delete');

    // Dokter Resep
    Route::get('/dokter-resep/{checkupId}', [App\Http\Controllers\DokterResepController::class, 'index'])->name('dokter-resep');
    Route::get('/dokter-resep/{id}', [App\Http\Controllers\DokterResepController::class, 'show'])->name('dokter-resep.show');
    Route::post('/dokter-resep', [App\Http\Controllers\DokterResepController::class, 'store'])->name('dokter-resep.store');
    Route::put('/dokter-resep/{id}', [App\Http\Controllers\DokterResepController::class, 'update'])->name('dokter-resep.update');
    Route::delete('/dokter-resep/{id}', [App\Http\Controllers\DokterResepController::class, 'delete'])->name('dokter-resep.delete');

    // Apoteker
    Route::get('/apoteker', [App\Http\Controllers\ApotekerController::class, 'index'])->name('apoteker');
    Route::get('/apoteker/pdf/{id}', [App\Http\Controllers\ApotekerController::class, 'pdf'])->name('apoteker.pdf');
    Route::get('/apoteker/{id}', [App\Http\Controllers\ApotekerController::class, 'show'])->name('apoteker.show');
    Route::post('/apoteker', [App\Http\Controllers\ApotekerController::class, 'store'])->name('apoteker.store');
    Route::put('/apoteker/{id}', [App\Http\Controllers\ApotekerController::class, 'update'])->name('apoteker.update');
    Route::delete('/apoteker/{id}', [App\Http\Controllers\ApotekerController::class, 'delete'])->name('apoteker.delete');
});


// Auth
Route::get('/login', [App\Http\Controllers\AuthController::class, 'create'])->name('auth');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'store'])->name('auth.create');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'destroy'])->name('auth.destroy');

// Logs
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

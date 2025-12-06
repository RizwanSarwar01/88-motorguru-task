<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

// Website routes (public)
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Dashboard route (authenticated)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/settings', function () {
    return view('settings');
})->middleware(['auth', 'verified', 'can:view settings'])->name('settings');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:view permissions')->group(function () {
        Route::resource('permissions', PermissionController::class)->except('show');
    });

    Route::middleware('can:view users')->group(function () {
        Route::resource('users', UserController::class)->except('show');
    });

    Route::middleware('can:view roles')->group(function () {
        Route::resource('roles', RoleController::class)->except('show');
    });

    Route::middleware('can:view countries')->group(function () {
        Route::resource('countries', CountryController::class);
    });

    Route::middleware('can:view cities')->group(function () {
        Route::resource('cities', CityController::class);
    });

    Route::resource('employees', EmployeeController::class);

    Route::get('city/search', [CityController::class, 'search'])->name('cities.search');
    Route::get('country/search', [CountryController::class, 'search'])->name('countries.search');
});





require __DIR__ . '/auth.php';

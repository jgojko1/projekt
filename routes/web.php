<?php
// use Illuminate\Support\Facades\Hash;
// dd(Hash::make('lozinka'));
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\Authenticate;


Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('auth.do_login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('register', [AuthController::class, 'postRegister'])->name('auth.do_register');
});

Route::group(['middleware' => Authenticate::class], function () {

    Route::resource('users', UserController::class);

    Route::get('/', [DashboardController::class, 'index_cached'])->name('home');

// Device Routes
    Route::resource('devices', DeviceController::class);

// Service Routes
    Route::resource('services', ServiceController::class);
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');

// Role Routes
    Route::resource('roles', RoleController::class);

});
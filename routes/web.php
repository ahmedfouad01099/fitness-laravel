<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'useractive']], function () {
    // Permission Module
    Route::resource('permission', PermissionController::class);
    Route::get('permission/add/{type}', [PermissionController::class, 'addPermission'])->name('permission.add');
    Route::post('permission/save', [PermissionController::class, 'savePermission'])->name('permission.save');

    Route::resource('role', RoleController::class);

    // Dashboard Routes
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('changeStatus', [HomeController::class, 'changeStatus'])->name('changeStatus');
});
//Auth pages Routs
Route::group(['prefix' => 'auth'], function () {
    Route::get('signin', [HomeController::class, 'signin'])->name('auth.signin');
    Route::get('signup', [HomeController::class, 'signup'])->name('auth.signup');
    Route::get('confirmmail', [HomeController::class, 'confirmmail'])->name('auth.confirmmail');
    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('recover-password', [HomeController::class, 'recoverpw'])->name('auth.recover-password');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');
});
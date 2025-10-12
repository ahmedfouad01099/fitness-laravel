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
    Route::get('signin', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('auth.signin');
    Route::get('signup', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('auth.signup');
    Route::get('confirmmail', function () {
        return view('auth.confirm-mail');
    })->name('auth.confirmmail');
    Route::get('lockscreen', function () {
        return view('auth.lockscreen');
    })->name('auth.lockscreen');
    Route::get('recover-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])->name('auth.recover-password');
    Route::get('userprivacysetting', function () {
        return view('auth.user-privacy-setting');
    })->name('auth.userprivacysetting');
});
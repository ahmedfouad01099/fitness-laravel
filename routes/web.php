<?php

use App\Http\Controllers\BodyPartController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\CategoryDietController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PostTagsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\WorkoutTypeController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});
Route::get('language/{locale}', [HomeController::class, 'changeLanguage'])->name('change.language');

Route::group(['middleware' => ['auth', 'useractive']], function () {
    // Permission Module
    Route::resource('permission', PermissionController::class);
    Route::get('permission/add/{type}', [PermissionController::class, 'addPermission'])->name('permission.add');
    Route::post('permission/save', [PermissionController::class, 'savePermission'])->name('permission.save');

    Route::resource('role', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('equipment', EquipmentController::class);
    Route::resource('exercise', ExerciseController::class);
    Route::resource('workout', WorkoutController::class);
    Route::post('workoutdays-exercise-delete', [ WorkoutController::class , 'workoutDaysExerciseDelete'])->name('workoutdays.exercise.delete');

    Route::resource('workouttype', WorkoutTypeController::class);
    Route::resource('diet', DietController::class);
    Route::resource('categorydiet', CategoryDietController::class);
    Route::resource('level', LevelController::class);
    Route::resource('bodypart', BodyPartController::class);
    Route::resource('product', ProductController::class);
    Route::resource('productcategory', ProductCategoryController::class);
    Route::resource('post', PostController::class);
    Route::resource('category', PostCategoryController::class);
    Route::resource('tags', PostTagsController::class);
    Route::resource('package', PackageController::class);
    Route::resource('subscription', SubscriptionController::class);

    Route::resource('pushnotification', PushNotificationController::class);
    Route::resource('quotes', QuotesController::class);

    Route::get('pages/term-condition', [SettingController::class, 'termAndCondition'])->name('pages.term_condition');
    Route::post('term-condition-save', [SettingController::class, 'saveTermAndCondition'])->name('pages.term_condition_save');
    Route::get('pages/privacy-policy', [SettingController::class, 'privacyPolicy'])->name('pages.privacy_policy');
    Route::get('setting/{page?}', [SettingController::class, 'settings'])->name('setting.index');
    Route::post('layout-page', [SettingController::class, 'layoutPage'])->name('layout_page');
    Route::post('settings/save', [SettingController::class, 'settingsUpdates'])->name('settingsUpdates');
    Route::post('mobile-config-save', [SettingController::class, 'settingUpdate'])->name('settingUpdate');
    Route::post('env-setting', [SettingController::class, 'envChanges'])->name('envSetting');
    Route::post('payment-settings/save', [SettingController::class, 'paymentSettingsUpdate'])->name('paymentSettingsUpdate');



    // Dashboard Routes
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('changeStatus', [HomeController::class, 'changeStatus'])->name('changeStatus');
});
Route::get('/ajax-list', [HomeController::class, 'getAjaxList'])->name('ajax-list');


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
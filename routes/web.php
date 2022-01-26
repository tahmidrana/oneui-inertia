<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NotificationCenterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserBulkUploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/debug-sentry', function () {
    throw new Exception('PHWC | My first Sentry error!');
});

Route::redirect('/', 'dashboard');

Route::middleware([
    'auth',
    // 'cache.headers:no_cache,no_store,must_revalidate,max_age=10;etag'
])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('users/{user}/password-reset', [UserController::class, 'passwordReset'])->name('users.password-reset');
    Route::get('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::get('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::resource('users', UserController::class);


    Route::resource('notification-center', NotificationCenterController::class)->only(['index']);


    Route::prefix('settings')->group(function () {
        //
    });

    Route::get('/users/set-user-type/{user_type}', [UserController::class, 'setUserType'])->name('set-user-type');

    Route::get('/ajax/users/get-users', [UserController::class, 'getUsers'])->name('users.get-users');

    Route::prefix('admin-console')->group(function () {
        Route::resource('menus', MenuController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('permissions', PermissionController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::get('user-types/{user_type}/config', [UserTypeController::class, 'config'])->name('user-types.config');
        Route::put('user-types/{user_type}/update-menus', [UserTypeController::class, 'updateMenus'])
            ->name('user-types.update-menus');
        Route::put('user-types/{user_type}/update-permissions', [UserTypeController::class, 'updatePermissions'])
            ->name('user-types.update-permissions');
        Route::resource('user-types', UserTypeController::class)->only(['index', 'store', 'update', 'destroy']);
    });

    Route::resource('user-bulk-upload', UserBulkUploadController::class)->only('index', 'store');
});


require __DIR__.'/auth.php';

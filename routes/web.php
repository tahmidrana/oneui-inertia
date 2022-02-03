<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NotificationCenterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserBulkUploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Application;
use Inertia\Inertia;

Route::get('/debug-sentry', function () {
    throw new Exception('PHWC | My first Sentry error!');
});

Route::redirect('/', 'dashboard');



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

/* Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */


Route::middleware([
    'auth',
    // 'cache.headers:no_cache,no_store,must_revalidate,max_age=10;etag'
])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('users/{user}/password-reset', [UserController::class, 'passwordReset'])->name('users.password-reset');
    Route::get('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::get('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::get('users/get-users', [UserController::class, 'getUsers'])->name('users.get-users');
    Route::resource('users', UserController::class);


    Route::resource('notification-center', NotificationCenterController::class)->only(['index']);


    Route::prefix('settings')->group(function () {
        //
    });

    Route::get('/users/set-user-type/{user_type}', [UserController::class, 'setUserType'])->name('set-user-type');


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

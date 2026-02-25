<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Ticketing\TicketController;
use App\Http\Controllers\Ticketing\TicketCategoryController;
use App\Http\Controllers\Ticketing\TicketReportController;
use App\Http\Controllers\Monitoring\MonitoringDashboardController;
use App\Http\Controllers\Monitoring\DeviceController;
use App\Http\Controllers\Monitoring\AlertController;
use App\Http\Controllers\Asset\AssetController;
use App\Http\Controllers\Asset\AssetCategoryController;
use App\Http\Controllers\Asset\AssetAssignmentController;
use App\Http\Controllers\Asset\AssetMaintenanceController;
use App\Http\Controllers\UserGuide\GuideController;
use App\Http\Controllers\UserGuide\GuideCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Locale Switch (accessible to everyone)
|--------------------------------------------------------------------------
*/
Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('locale.switch');

/*
|--------------------------------------------------------------------------
| Public Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', fn() => redirect('/login'));
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetPassword'])->name('password.send');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/module-status', [DashboardController::class, 'updateModuleStatus'])->name('dashboard.module.status');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Change Password
    Route::get('/password/change', [ChangePasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password/change', [ChangePasswordController::class, 'update'])->name('password.update');

    /*
    |----------------------------------------------------------------------
    | Admin Routes (super_admin & admin only)
    |----------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware('module:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
        Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');

        Route::resource('branches', \App\Http\Controllers\Admin\BranchController::class)->except(['show', 'create', 'edit'])->names('admin.branches');
        Route::resource('divisions', \App\Http\Controllers\Admin\DivisionController::class)->except(['show', 'create', 'edit'])->names('admin.divisions');
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show', 'create', 'edit'])->names('admin.categories');
    });

    /*
    |----------------------------------------------------------------------
    | Ticketing Module
    |----------------------------------------------------------------------
    */
    Route::prefix('ticketing')->middleware('module:ticketing')->name('ticketing.')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/create', [TicketController::class, 'create'])->name('create');
        Route::post('/', [TicketController::class, 'store'])->name('store');
        Route::get('/{ticket}', [TicketController::class, 'show'])->name('show');
        Route::put('/{ticket}', [TicketController::class, 'update'])->name('update');

        Route::resource('categories', TicketCategoryController::class)->except(['show']);
        Route::get('/reports', [TicketReportController::class, 'index'])->name('reports.index');
    });

    /*
    |----------------------------------------------------------------------
    | Monitoring Module
    |----------------------------------------------------------------------
    */
    Route::prefix('monitoring')->middleware('module:monitoring')->name('monitoring.')->group(function () {
        Route::get('/', [MonitoringDashboardController::class, 'index'])->name('dashboard');
        Route::resource('devices', DeviceController::class);
        Route::get('/alerts', [AlertController::class, 'index'])->name('alerts.index');
        Route::post('/alerts/{alert}/resolve', [AlertController::class, 'resolve'])->name('alerts.resolve');
    });

    /*
    |----------------------------------------------------------------------
    | Asset Module
    |----------------------------------------------------------------------
    */
    Route::prefix('asset')->middleware('module:asset')->name('asset.')->group(function () {
        Route::get('/', [AssetController::class, 'index'])->name('index');
        Route::get('/create', [AssetController::class, 'create'])->name('create');
        Route::post('/', [AssetController::class, 'store'])->name('store');
        Route::get('/{asset}', [AssetController::class, 'show'])->name('show');
        Route::get('/{asset}/edit', [AssetController::class, 'edit'])->name('edit');
        Route::put('/{asset}', [AssetController::class, 'update'])->name('update');
        Route::delete('/{asset}', [AssetController::class, 'destroy'])->name('destroy');

        Route::resource('categories', AssetCategoryController::class)->except(['show']);
        Route::get('/assignments', [AssetAssignmentController::class, 'index'])->name('assignments.index');
        Route::post('/assignments', [AssetAssignmentController::class, 'store'])->name('assignments.store');
        Route::get('/maintenance', [AssetMaintenanceController::class, 'index'])->name('maintenance.index');
    });

    /*
    |----------------------------------------------------------------------
    | User Guide Module
    |----------------------------------------------------------------------
    */
    Route::prefix('userguide')->middleware('module:userguide')->name('userguide.')->group(function () {
        Route::get('/', [GuideController::class, 'index'])->name('index');
        Route::get('/create', [GuideController::class, 'create'])->name('create');
        Route::post('/', [GuideController::class, 'store'])->name('store');
        Route::get('/{slug}', [GuideController::class, 'show'])->name('show');
        Route::get('/{guide}/edit', [GuideController::class, 'edit'])->name('edit');
        Route::put('/{guide}', [GuideController::class, 'update'])->name('update');
        Route::delete('/{guide}', [GuideController::class, 'destroy'])->name('destroy');

        Route::resource('categories', GuideCategoryController::class)->except(['show']);
    });
});

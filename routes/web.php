<?php
// routes/web.php - COMPLETE FIXED VERSION

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

// Guest Routes (Not Authenticated)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    
    // Optional: Registration (comment out if not needed)
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
});

// Admin Routes (Authenticated + Role Check)
Route::middleware(['auth', 'role:super-admin,admin,manager'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('permission:view-dashboard');
    
    // User Management Routes
    Route::middleware('permission:view-users')->group(function () {
        // Index - with GET for filters
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        
        // Show specific user
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    });
    
    Route::middleware('permission:create-users')->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
    });
    
    Route::middleware('permission:edit-users')->group(function () {
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    });
    
    Route::middleware('permission:delete-users')->group(function () {
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    
    // Role Management (Super Admin & Admin only)
    Route::middleware('role:super-admin,admin')->group(function () {
        Route::resource('roles', RoleController::class)->except(['show']);
    });
});
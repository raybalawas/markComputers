<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\SuperAdminAuthController;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest only)
|--------------------------------------------------------------------------
*/

Route::prefix('superadmin')->name('superadmin.')->group(function () {

    // Guest routes (only accessible when not logged in)
    Route::middleware('superadmin.guest')->group(function () {
        Route::get('/register', [SuperAdminAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [SuperAdminAuthController::class, 'register'])->name('register.submit');
        Route::get('/login', [SuperAdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [SuperAdminAuthController::class, 'login'])->name('login.submit');
    });
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Authentication Required)
|--------------------------------------------------------------------------
*/

Route::prefix('superadmin')
    ->name('superadmin.')
    ->middleware(['superadmin.auth'])  // Apply auth middleware
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [SuperAdminAuthController::class, 'dashboard'])->name('dashboard');

        // Logout
        Route::post('/logout', [SuperAdminAuthController::class, 'logout'])->name('logout');

        /*
        |--------------------------------------------------------------------------
        | Category Management Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
            Route::put('/status/{id}', [CategoryController::class, 'changeStatus'])->name('status');
        });

        /*
        |--------------------------------------------------------------------------
        | Course Management Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('courses')->name('courses.')->group(function () {
            Route::get('/', [CourseController::class, 'index'])->name('index');
            Route::get('/create', [CourseController::class, 'create'])->name('create');
            Route::post('/store', [CourseController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CourseController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [CourseController::class, 'destroy'])->name('destroy');
            Route::put('/status/{id}', [CourseController::class, 'changeStatus'])->name('status');
        });

        /*
        |--------------------------------------------------------------------------
        | Enquiry Management Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('enquiry')->name('enquiry.')->group(function () {
            Route::get('/', [EnquiryController::class, 'index'])->name('index');
            Route::get('/create', [EnquiryController::class, 'create'])->name('create');
            Route::post('/store', [EnquiryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [EnquiryController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [EnquiryController::class, 'update'])->name('update');
            Route::get('/show/{id}', [EnquiryController::class, 'show'])->name('show');
            Route::get('/{id}/id-card', [EnquiryController::class, 'downloadIdCard'])->name('idcard');
            Route::delete('/destroy/{id}', [EnquiryController::class, 'destroy'])->name('destroy');
        });
    });

/*
|--------------------------------------------------------------------------
| Default Redirect
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->guard('superadmin')->check()) {
        return redirect()->route('superadmin.dashboard');
    }
    return redirect()->route('superadmin.login');
});
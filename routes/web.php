<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\SuperAdminAuthController;

/*
|--------------------------------------------------------------------------
| Public Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return redirect()->route('superadmin.login');
})->name('login');

Route::prefix('superadmin')->name('superadmin.')->group(function () {

    // Register
    Route::get('/register', [SuperAdminAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [SuperAdminAuthController::class, 'register'])->name('register.submit');

    // Login
    Route::get('/login', [SuperAdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [SuperAdminAuthController::class, 'login'])->name('login.submit');
});


/*
|--------------------------------------------------------------------------
| Protected Super Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('superadmin')
    ->name('superadmin.')
    ->middleware('auth:superadmin')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [SuperAdminAuthController::class, 'dashboard'])
            ->name('dashboard');

        // Logout
        Route::post('/logout', [SuperAdminAuthController::class, 'logout'])
            ->name('logout');

        /*
        |--------------------------------------------------------------------------
        | Category Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

            Route::put('/status/{id}', [CategoryController::class, 'changeStatus'])
                ->name('categories.status');
        });

        /*
        |--------------------------------------------------------------------------
        | Course Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('courses')->group(function () {
            Route::get('/', [CourseController::class, 'index'])->name('courses.index');
            Route::get('/create', [CourseController::class, 'create'])->name('courses.create');
            Route::post('/store', [CourseController::class, 'store'])->name('courses.store');
            Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('courses.edit');
            Route::put('/update/{id}', [CourseController::class, 'update'])->name('courses.update');
            Route::delete('/destroy/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
            Route::put('/status/{id}', [CourseController::class, 'changeStatus'])
                ->name('courses.status');
        });

        /*
        |--------------------------------------------------------------------------
        | Enquiry Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('enquiry')->group(function () {
            Route::get('/', [EnquiryController::class, 'index'])->name('enquiry.index');
            Route::get('/create', [EnquiryController::class, 'create'])->name('enquiry.create');
            Route::post('/store', [EnquiryController::class, 'store'])->name('enquiry.store');
            Route::get('/edit/{id}', [EnquiryController::class, 'edit'])->name('enquiry.edit');
            Route::put('/update/{id}', [EnquiryController::class, 'update'])->name('enquiry.update');
            Route::get('/show/{id}', [EnquiryController::class, 'show'])->name('enquiry.show');
            Route::get('/{id}/id-card', [EnquiryController::class, 'downloadIdCard'])->name('enquiry.idcard');
            Route::delete('/destroy/{id}', [EnquiryController::class, 'destroy'])->name('enquiry.destroy');
        });
    });


/*
|--------------------------------------------------------------------------
| Default Redirect
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('superadmin.login');
});

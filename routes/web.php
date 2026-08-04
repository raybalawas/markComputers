<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\LibrarySeatController;
use App\Http\Controllers\Admin\PgResidentController; // ✅ Correct Admin Namespace
use App\Http\Controllers\Admin\PgRoomsController;    // ✅ Correct Admin Namespace
use App\Http\Controllers\LibraryStudentController;
use App\Http\Controllers\SuperAdminAuthController;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest only)
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return redirect()->route('superadmin.login');
})->name('login');

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
    ->middleware(['superadmin.auth'])
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

        /*
            |--------------------------------------------------------------------------
            | Library Student Management Routes
            |--------------------------------------------------------------------------
         */
        Route::prefix('library-students')->name('library-students.')->group(function () {
            Route::get('/', [LibraryStudentController::class, 'index'])->name('index');
            Route::get('/create', [LibraryStudentController::class, 'create'])->name('create');
            Route::post('/', [LibraryStudentController::class, 'store'])->name('store');
            Route::get('/{id}', [LibraryStudentController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [LibraryStudentController::class, 'edit'])->name('edit');
            Route::put('/{id}', [LibraryStudentController::class, 'update'])->name('update');
            Route::delete('/{id}', [LibraryStudentController::class, 'destroy'])->name('destroy');
            Route::put('/status/{id}', [LibraryStudentController::class, 'changeStatus'])->name('status');
        });


        Route::prefix('seats')->name('seats.')->group(function () {
            Route::get('/', [LibrarySeatController::class, 'index'])->name('index');
            Route::get('/create', [LibrarySeatController::class, 'create'])->name('create');
            Route::post('/', [LibrarySeatController::class, 'store'])->name('store');
            Route::get('/generate', [LibrarySeatController::class, 'bulkGenerate'])->name('generate');
            Route::get('/{id}', [LibrarySeatController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [LibrarySeatController::class, 'edit'])->name('edit');
            Route::put('/{id}', [LibrarySeatController::class, 'update'])->name('update');
            Route::delete('/{id}', [LibrarySeatController::class, 'destroy'])->name('destroy');

            Route::put('/status/{id}', [LibrarySeatController::class, 'changeStatus'])->name('status');
        });



        Route::prefix('pg-residents')->name('pg-residents.')->group(function () {
            // ✅ Correct namespace used here
            Route::get('/', [PgResidentController::class, 'index'])->name('index');
            Route::get('/create', [PgResidentController::class, 'create'])->name('create');
            Route::post('/', [PgResidentController::class, 'store'])->name('store');
            Route::get('/{id}', [PgResidentController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [PgResidentController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PgResidentController::class, 'update'])->name('update');
            Route::delete('/{id}', [PgResidentController::class, 'destroy'])->name('destroy');
            Route::put('/status/{id}', [PgResidentController::class, 'changeStatus'])->name('status');
        });

        Route::prefix('rooms')->name('pg-rooms.')->group(function () {
            // ✅ Correct namespace used here
            Route::get('/', [PgRoomsController::class, 'index'])->name('index');
            Route::get('/create', [PgRoomsController::class, 'create'])->name('create');
            Route::post('/', [PgRoomsController::class, 'store'])->name('store');
            Route::get('/generate', [PgRoomsController::class, 'bulkGenerate'])->name('generate');
            Route::get('/{id}', [PgRoomsController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [PgRoomsController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PgRoomsController::class, 'update'])->name('update');
            Route::delete('/{id}', [PgRoomsController::class, 'destroy'])->name('destroy');
            Route::put('/status/{id}', [PgRoomsController::class, 'changeStatus'])->name('status');
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
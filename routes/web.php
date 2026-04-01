<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EnquiryController;

Route::get('/', function () {
    return redirect()->route('enquiry.index');
});

Route::prefix('admin')->group(function () {
    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

    // Course Routes
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');

    // Enquiry Routes
    Route::get('/enquiry', [EnquiryController::class, 'index'])->name('enquiry.index');
    Route::get('/enquiry/create', [EnquiryController::class, 'create'])->name('enquiry.create');
    Route::post('/enquiry/store', [EnquiryController::class, 'store'])->name('enquiry.store');

    Route::get('/enquiry/{id}/id-card', [EnquiryController::class, 'downloadIdCard'])->name('enquiry.idcard');
});
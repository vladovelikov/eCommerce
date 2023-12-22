<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubcategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web", "auth", and "role:admin" middleware groups. Make something great!
|
*/

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');


/** Slider Routes */

Route::resource('slider', SliderController::class);


/** Category Routes */

Route::put('update-status', [CategoryController::class, 'updateStatus'])->name('category.update.status');
Route::resource('category', CategoryController::class);


/** Subcategory Routes */

Route::put('update-subcategory-status', [SubcategoryController::class, 'updateStatus'])->name('subcategory.update.status');
Route::resource('subcategory', SubcategoryController::class);


/** Child Categories Routes */

Route::put('update-child-category-status', [ChildCategoryController::class, 'updateStatus'])->name('child-category.update.status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubcategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

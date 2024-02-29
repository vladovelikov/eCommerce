<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Vendor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register vendor routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web", "auth", and "role:vendor" middleware groups. Make something great!
|
*/

/** Vendor Routes */

Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

/** Vendor Shop Profile Routes */

Route::resource('shop-profile', VendorShopProfileController::class);

/** Vendor Product Routes */
Route::get('product/get-subcategories', [VendorProductController::class, 'getSubcategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [VendorProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::put('product/update-status', [VendorProductController::class, 'updateStatus'])->name('product.update-status');
Route::resource('products', VendorProductController::class)->except(['edit']);
Route::get('products/{id}/edit', [VendorProductController::class, 'edit'])->name('products.edit')->middleware('check.product.owner');

/** Vendor Products Image Gallery Routes*/
Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

/** Vendor Products Variants Routes */
//Route::put('products-variants/update-status', [VendorProductVariantController::class, 'updateStatus'])->name('products-variants.update-status');
Route::resource('products-variants', VendorProductVariantController::class);

///** Vendor Product Variant Items Routes */
//Route::get('product-variant-items/{productId}/{variantId}', [VendorProductVariantItemController::class, 'index'])->name('product-variant-items.index');
//Route::get('product-variant-items/create/{productId}/{variantId}', [VendorProductVariantItemController::class, 'create'])->name('product-variant-items.create');
//Route::get('product-variant-items/{variantItemId}', [VendorProductVariantItemController::class, 'edit'])->name('product-variant-items.edit');
//Route::post('product-variant-items', [VendorProductVariantItemController::class, 'store'])->name('product-variant-items.store');
//Route::put('product-variant-items/updateStatus', [VendorProductVariantItemController::class, 'updateStatus'])->name('product-variant-items.update-status');
//Route::put('product-variant-items/update/{variantItemId}', [VendorProductVariantItemController::class, 'update'])->name('product-variant-items.update');
//Route::delete('product-variant-items/destroy/{variantItemId}', [VendorProductVariantItemController::class, 'destroy'])->name('product-variant-items.destroy');

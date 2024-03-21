<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingsController;
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


/** Brands Routes */
Route::put('brand/update-status', [BrandController::class, 'updateStatus'])->name('brand.update-status');
Route::resource('brand', BrandController::class);


/** Vendor Profile Routes */
Route::resource('vendor-profile', AdminVendorProfileController::class);


/** Products Routes */
Route::get('product/get-subcategories', [ProductController::class, 'getSubcategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::put('product/update-status', [ProductController::class, 'updateStatus'])->name('product.update-status');
Route::resource('products', ProductController::class);

/** Products Image Gallery Routes*/
Route::resource('products-image-gallery', ProductImageGalleryController::class);

/** Products Variants Routes */
Route::put('products-variants/update-status', [ProductVariantController::class, 'updateStatus'])->name('products-variants.update-status');
Route::resource('products-variants', ProductVariantController::class);

/** Product Variant Items Routes */
Route::get('product-variant-items/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('product-variant-items.index');
Route::get('product-variant-items/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('product-variant-items.create');
Route::get('product-variant-items/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('product-variant-items.edit');
Route::post('product-variant-items', [ProductVariantItemController::class, 'store'])->name('product-variant-items.store');
Route::put('product-variant-items/updateStatus', [ProductVariantItemController::class, 'updateStatus'])->name('product-variant-items.update-status');
Route::put('product-variant-items/update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('product-variant-items.update');
Route::delete('product-variant-items/destroy/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('product-variant-items.destroy');

/** Seller Products Routes */
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-pending-products', [SellerProductController::class, 'pendingProducts'])->name('seller-pending-products.index');
Route::put('update-approval-status', [SellerProductController::class, 'updateApprovalStatus'])->name('update-approval-status');

/** Flash Sale Products Routes */
Route::resource('flash-sale', FlashSaleController::class);

/** Settings Routes */
Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
Route::put('update-settings', [SettingsController::class, 'update'])->name('settings.update');


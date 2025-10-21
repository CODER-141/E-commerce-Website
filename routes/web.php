<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class,'home'])->name('index');
Route::get('/product_details/{id}',[UserController::class,'productDetails'])->name('product_details');
Route::get('/allproducts',[UserController::class,'allProducts'])->name('viewallproducts');

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/addtocart/{id}', [UserController::class, 'addToCart'])->middleware(['auth', 'verified'])->name('add_to_cart');
Route::get('/cartproducts', [UserController::class, 'cartProducts'])->middleware(['auth', 'verified'])->name('cartproducts');
Route::get('/removecartproduct/{id}', [UserController::class, 'removeCartProduct'])->middleware(['auth', 'verified'])->name('removecartproduct');
Route::post('/confirm_order', [UserController::class, 'confirmOrder'])->middleware(['auth', 'verified'])->name('confirm_order');
Route::get('/myorders', [UserController::class, 'myOrders'])->middleware(['auth', 'verified'])->name('myorders');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    route::post('/add_category', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');
    Route::get('/view_category', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');
    Route::get('/delete_category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categorydelete');
    Route::get('/update_category/{id}', [AdminController::class, 'updateCategory'])->name('admin.categoryupdate');
    Route::post('/update_category/{id}', [AdminController::class, 'postUpdateCategory'])->name('admin.postupdatecategory');
    Route::get('/add_product', [AdminController::class, 'addProduct'])->name('admin.addproduct');
    route::post('/add_product', [AdminController::class, 'postAddProduct'])->name('admin.postaddproduct');
    Route::get('/view_product', [AdminController::class, 'viewProduct'])->name('admin.viewproduct');
    Route::get('/delete_product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteproduct');
    Route::get('/update_product/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateproduct');
    route::post('/update_product/{id}', [AdminController::class, 'postUpdateProduct'])->name('admin.postupdateproduct');
    route::any('/search', [AdminController::class, 'searchProduct'])->name('admin.searchproduct');
    Route::get('/vieworders', [AdminController::class, 'viewOrders'])->name('admin.vieworders');
    Route::post('/change_status/{id}', [AdminController::class, 'changeStatus'])->name('admin.change_status');
    Route::get('/downloadpdf/{id}', [AdminController::class, 'downloadPDF'])->name('admin.downloadpdf');
    
    

});

require __DIR__ . '/auth.php';

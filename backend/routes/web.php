<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ChangePasswordController;

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\CategoriesController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/category', [CategoryController::class, 'store']);
Route::get('/supplier', [SupplierController::class, 'store']);
Route::get('/unit', [UnitController::class, 'store']);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

    Route::resource('/item',ItemController::class);
    Route::resource('/cart',CartController::class)->except('store');
    Route::post('/cart/{item_id}/store', [CartController::class, 'store'])->name('cart.store');

    Route::group(["prefix" => "admin/", "as" => "admin.", 'middleware' => 'can:admin'], function () {
        #users
        Route::get('/users',[UsersController::class,'index'])->name('index');
        Route::delete('/users/{id}/deactivate',[UsersController::class,'deactivate'])->name('deactivate');
        Route::post('/users/{id}/activate',[UsersController::class,'activate'])->name('activate');
        Route::patch('/users/{id}/update',[UsersController::class,'update'])->name('update');
        Route::delete('/users/{id}/destroy',[UsersController::class,'destroy'])->name('users.destroy');

        #password
        Route::get('/password/{id}/change', [ChangePasswordController::class,'edit']);
        Route::patch('/password/{id}/change',[ChangePasswordController::class,'update'])->name('password.change');

        #suppliers
        Route::get('/suppliers',[SuppliersController::class,'index'])->name('suppliers.index');
        Route::post('/suppliers/store',[SuppliersController::class,'store'])->name('suppliers.store');
        Route::patch('/suppliers/{id}/update',[SuppliersController::class,'update'])->name('suppliers.update');
        Route::delete('/suppliers/{id}/destroy',[SuppliersController::class,'destroy'])->name('suppliers.destroy');

        #categories
        Route::get('/categories',[CategoriesController::class,'index'])->name('categories.index');
        Route::post('/categories/store',[CategoriesController::class,'store'])->name('categories.store');
        Route::patch('/categories/{id}/update',[CategoriesController::class,'update'])->name('categories.update');
        Route::delete('/categories/{id}/destroy',[CategoriesController::class,'destroy'])->name('categories.destroy');
    });


});
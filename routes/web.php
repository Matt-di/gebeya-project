<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginContrller;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MerchanProductController;
use App\Http\Controllers\MerchantDashboardorController;

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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('{user_id}/cart',[CartController::class, 'index']);

Route::get('{user_id}/order',[OrderController::class, 'store']);
Route::get('{user_id}/orders',[OrderController::class, 'index']);
Route::post('{user_id}/order',[OrderController::class, 'store']);

Route::get('/login', [LoginContrller::class, 'index'])->name("login");
Route::post('/login', [LoginContrller::class, 'store'])->name('login');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name("register");
Route::post('/register',[RegisterController::class, 'store']);


Route::get('/admin',[AdminController::class, 'index'])->name('admin');
Route::post('/admin',[AdminController::class, 'store'])->name('admin');

Route::get('/admin/dashboard',[AdminDashboard::class, 'index'])->name('admin.dashboard');

Route::get('/dashboard',[MerchantDashboardorController::class,'index'])->name('merchant.dashboard');

Route::get('/products',[MerchanProductController::class, 'index'])->name('products');
Route::post('/products',[MerchanProductController::class, 'store'])->name('products.add');
Route::get('/products/{product}',[MerchanProductController::class, 'index'])->name('products.get');

Route::get('/products/{product}/get',[MerchanProductController::class, 'getProduct'])->name('product.get');
Route::delete('/products/{product}',[MerchanProductController::class, 'destroy'])->name('product.delete');
Route::post('/products/{product}/update',[MerchanProductController::class, 'update'])->name('product.update');

Route::get('/category',[CategoryController::class, 'index'])->name('category');
Route::post('/category',[CategoryController::class, 'store'])->name('category.add');

Route::get('/category/{category}',[CategoryController::class, 'get'])->name('category.get');
Route::delete('/category/{category}',[CategoryController::class, 'destroy'])->name('category.delete');

Route::get('/category/{category}/product',[CategoryController::class, 'getProducts'])->name('category.products');

Route::post('/category/{category}/update',[CategoryController::class, 'update'])->name('category.update');
Route::post('/category/{category}/enable',[CategoryController::class, 'showInNav'])->name('category.enable');

Route::get('/orders',[OrderController::class, 'getOrders'])->name('orders');


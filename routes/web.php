<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginContrller;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/home', [ProductController::class, 'index'])->name('home');
Route::get('/', [ProductController::class, 'index'])->name('/');

Route::get('/login', [LoginContrller::class, 'index'])->name("login");
Route::post('/login', [LoginContrller::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name("register");
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin.login');
Route::post('/admin', [AdminController::class, 'identify']);

Route::group(['prefix'=>'/user/{user}','as'=>'user.','middleware' => 'auth'], function () {
    Route::get("/", [ProductController::class, 'index']);
    Route::get('order', [OrderController::class, 'store'])->name('order.add');
    Route::post('order', [OrderController::class, 'addOrder']);

    Route::get('orders', [OrderController::class, 'index'])->name("orders.all");

    Route::get('orders/{order}', [OrderController::class, 'singleOrder'])->name("orders.single");

    Route::put('{payment}', [OrderController::class, 'updatePaymentStatus'])->name('payment.update');


    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::post('cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('cart/{cart}', [CartController::class, 'destroy'])->name('cart.delete');
    Route::put('cart/{cart}', [CartController::class, 'updateQuantity'])->name('cart.update');

    Route::get('products/{product}', [ProductController::class, 'getProduct'])->name('product.get');
});

Route::group(['prefix'=>'/user/{user}','as'=>'user.','middleware' => ['auth', 'checkUser']], function () {
    Route::get('dashboard', [MerchantDashboardorController::class, 'index'])->name('merchant.dashboard');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.login');

    Route::get('users', [UserController::class, 'index'])->name('users');

    Route::get('userorders', [OrderController::class, 'getOrders'])->name('merchant.orders');
    Route::get('userorder/{order}', [OrderController::class, 'singleOrder'])->name('merchant.orders.single');
    Route::post('userorders/{order}', [OrderController::class, 'updateStatus'])->name('merchant.orders.update');

    Route::get('products', [MerchanProductController::class, 'index'])->name('products');
    Route::post('products', [MerchanProductController::class, 'store']);
    Route::get('products/{product}', [MerchanProductController::class, 'findProduct'])->name('products.find');
    Route::get('products/{product}/get', [ProductController::class, 'getProduct'])->name('products.get');
    Route::delete('products/{product}', [MerchanProductController::class, 'destroy'])->name('product.delete');
    Route::post('products/{product}/update', [MerchanProductController::class, 'update'])->name('product.update');
    Route::post('products/delete', [StoreController::class, 'destroy'])->name('products.delete.all');

    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::post('category', [CategoryController::class, 'store'])->name('category.add');
    Route::get('{category}', [CategoryController::class, 'get'])->name('category.get');
    Route::delete('{category}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('{category}/product', [CategoryController::class, 'getProducts'])->name('category.products');
    Route::delete('{category}/{product}', [MerchanProductController::class, 'removeCategory'])->name('category.product.delete');
    Route::post('{category}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::post('{category}/enable', [CategoryController::class, 'showInNav'])->name('category.enable');
});

Route::get('/products/{product}/get', [ProductController::class, 'getProduct'])->name('product.get');

Route::group(['prefix'=>'/','as'=>'admin.','middleware'=>'auth:web_admin'],function () {
    Route::post('admin/add', [AdminController::class, 'store'])->name('add');
    Route::get('admin/users', [AdminController::class, 'users'])->name('users');
    Route::post('admin/{admin}', [AdminController::class, 'delete'])->name('delete');
    Route::get('admin/{admin}', [AdminController::class, 'getAdmin'])->name('view');
    Route::get('system/users', [AdminController::class, 'users'])->name('system.users');

    Route::get('admin/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('admin/stores', [StoreController::class, 'index'])->name('stores');

    Route::get('admin/store/product', [StoreController::class, 'index'])->name('store.products');
    Route::post('admin/stores', [StoreController::class, 'store'])->name('store.add');
    Route::post('admin/stores/{user}', [StoreController::class, 'enable'])->name('store.enable');
    Route::post('admin/stores/{store_id}', [StoreController::class, 'destroy'])->name('store.delete');
});

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
use App\Http\Controllers\Admin\AdminLoginController;
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

Route::get('/', [ProductController::class, 'index'])->name('/');
Route::get('/home', [ProductController::class, 'index'])->name('home');

Auth::routes();
// Route::get('/login/admin', [LoginContrller::class, 'adminIndex'])->name('admin.login');
Route::get('/login', [LoginContrller::class, 'index'])->name('login');

// Route::post('/login/admin', [LoginContrller::class, 'adminLogin']);
Route::post('/login', [LoginContrller::class, 'clientLogin']);

// Route::get('/register', [RegisterController::class,'index'])->name('register');
// Route::post('/register', [RegisterController::class, 'store']);


Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
Route::get('products/{product}', [ProductController::class, 'getProduct'])->name('product.get');


Route::group(['prefix' => '/{user}', 'as' => 'user.', 'middleware' => ['auth','checkUser']], function () {
    Route::get("/", [ProductController::class, 'index'])->name('/');

    Route::resource('carts', CartController::class);

    Route::get('order', [OrderController::class, 'store'])->name('order.add');
    Route::post('order', [OrderController::class, 'addOrder']);

    Route::get('orders', [OrderController::class, 'index'])->name("orders");

    Route::get('orders/{order}', [OrderController::class, 'singleOrder'])->name("orders.single");

    Route::put('{payment}', [OrderController::class, 'updatePaymentStatus'])->name('payment.update');

    Route::get('products/{product}', [ProductController::class, 'getProduct'])->name('product.get');
});


    Route::group(['prefix' => '/{user}', 'as' => 'merchant.', 'middleware' => ['auth','checkUser']], function () {
        Route::resource('products', MerchanProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::get('/', [MerchantDashboardorController::class, 'index']);
        Route::get('dashboard', [MerchantDashboardorController::class, 'index'])->name('dashboard');
        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::get('userorders', [OrderController::class, 'store'])->name('order.add');
        Route::get('userorders', [OrderController::class, 'getOrders'])->name('orders');
        Route::get('userorders/{order}', [OrderController::class, 'userOrder'])->name('orders.single');
        Route::post('userorders/{order}', [OrderController::class, 'updateStatus'])->name('orders.update');

        Route::get('{category}/', [CategoryController::class, 'getProducts'])->name('category.products');
        Route::delete('{category}/{product}', [MerchanProductController::class, 'removeCategory'])->name('category.product.delete');
        Route::post('{category}/update', [CategoryController::class, 'update'])->name('category.update');
        Route::post('{category}/enable', [CategoryController::class, 'showInNav'])->name('category.enable');
    });


    Route::middleware('admin')->group(['prefix' => '/', 'as' => 'admin.'], function () {
        Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::get('/admin/stores', [StoreController::class, 'index'])->name('stores');

        Route::get('/admin/store/product', [StoreController::class, 'index'])->name('store.products');
        Route::post('/admin/stores', [StoreController::class, 'store'])->name('store.add');
        Route::post('/admin/stores/{user}', [StoreController::class, 'enable'])->name('store.enable');
        Route::delete('/admin/stores/{store}', [StoreController::class, 'destroy'])->name('store.delete');

        Route::post('/admin/add', [AdminController::class, 'store'])->name('add');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('users');
        Route::post('/admin/{admin}', [AdminController::class, 'delete'])->name('delete');
        Route::get('/admin/{admin}', [AdminController::class, 'getAdmin'])->name('view');
        Route::get('/admin/system/users', [AdminController::class, 'users'])->name('system.users');
});

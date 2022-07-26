<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\MerchanProductController;
use App\Http\Controllers\MerchantDashboardorController;
use App\Http\Controllers\Admin\AdminDashboardController;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
// Route::get('products/{product}', [ProductController::class, 'getProduct'])->name('product.get');
Route::get('store/{id}/{category}', [ProductController::class, 'getProducts'])->name('userstore');

Route::get('store/{id}', [StoreController::class, 'products'])->name('stores.products');
Route::get('stores/{id}/{product}', [ProductController::class, 'getProduct'])->name('product.get');

// Route::group(['prefix' => '/{user}', 'as' => 'user.', 'middleware' => 'clientRole'], function () {
Route::get("/", [ProductController::class, 'index'])->name('storefront');
Route::get("/home", [ProductController::class, 'index'])->name('home');
Route::resource('carts', CartController::class);

Route::get('order', [OrderController::class, 'create'])->name('order.create');
Route::post('order', [OrderController::class, 'addOrder'])->name('order.add');
Route::get('orders', [OrderController::class, 'index'])->name("orders");
Route::get('orders/{order}', [OrderController::class, 'singleOrder'])->name("orders.single");

Route::put('{payment}', [OrderController::class, 'updatePaymentStatus'])->name('payment.update');

Route::post('upgrade', [UserController::class, 'upgrade'])->name('upgrade');

Route::resource('stores', StoreController::class,['as'=>'user']);



Route::group(['prefix' => '/merchant/{user}', 'as' => 'merchant.', 'middleware' => 'checkUser'], function () {
    Route::resource('products', MerchanProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::get("/", [ProductController::class, 'index'])->name('storefront');

    // Route::get('/', [MerchantDashboardorController::class, 'index']);

    Route::get('dashboard', [MerchantDashboardorController::class, 'index'])->name('dashboard');
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('userorders', [OrderController::class, 'index'])->name('order.get');
    Route::get('userorders', [OrderController::class, 'store'])->name('order.add');
    // Route::get('userorders', [OrderController::class, 'getOrders'])->name('orders');
    Route::get('profiles', [UserController::class, 'profile'])->name('profile');
    // Route::get('userorders/{order}', [OrderController::class, 'userOrder'])->name('orders.single');
    Route::post('userorders/{order}', [OrderController::class, 'updateStatus'])->name('userorders.update');
    Route::put('/payment/{payment}', [OrderController::class, 'updatePaymentStatus'])->name('payment.update');

    Route::get('{category}/', [CategoryController::class, 'getProducts'])->name('category.products');
    Route::delete('{category}/{product}', [MerchanProductController::class, 'removeCategory'])->name('category.product.delete');
    Route::post('{category}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::post('{category}/enable', [CategoryController::class, 'showInNav'])->name('category.enable');
});
Route::get('/back-to-admin', [UserController::class, 'leaveImpersonate'])->name('users.leave-impersonate');

Route::group(["prefix" => 'admin/', 'as' => 'admin.', "middleware" => 'isAdmin'], function () {
    Route::get('dashoard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('stores', StoreController::class);
    Route::get('/{user}/login', [UserController::class, 'impersonate'])->name('users.impersonate');
    Route::get('/admins', [UserController::class, 'admins'])->name('admins.users');

    Route::get('stores/product', [StoreController::class, 'index'])->name('stores.products');
    Route::delete('stores/{id}/wipe', [StoreController::class, 'wipe'])->name('stores.wipe');
    Route::post('stores/{user}/enable', [StoreController::class, 'enable'])->name('store.enable');

});

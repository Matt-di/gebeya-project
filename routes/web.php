<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginContrller;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;

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
});

Route::get('{user_id}/cart',[CartController::class, 'index']);

Route::get('{user_id}/order',[OrderController::class, 'store']);
Route::get('{user_id}/orders',[OrderController::class, 'index']);
Route::post('{user_id}/order',[OrderController::class, 'store']);

Route::get('/login', [LoginContrller::class, 'index'])->name("login");
Route::post('/login', [LoginContrller::class, 'store'])->name('login');

Route::get('/register', [RegisterController::class, 'index'])->name("register");


Route::get('/admin', function(){
    return view('auth.login');
});
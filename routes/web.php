<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\paypalController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', 'Website\HomeController@index')->name('home');

Route::middleware('auth')->group(function(){
    Route::get('/cart','Website\CartController@index')->name('cart');
    Route::get('/single-product/{id}','Website\singleprodController@index');
    Route::post('/insert','Website\CartController@insertCart');
    Route::post('/delete-cart','Website\CartController@remove');
    Route::get('/check-out','Website\checkoutController@index');
    Route::post('/place-order','Website\checkoutController@insert');
    Route::post('/payment',[paypalController::class,'payment'])->name('payment');
    Route::get('/cancel',[paypalController::class,'cancel'])->name('payment.cancel');
    Route::get('/success',[paypalController::class,'success'])->name('payment.success');
});
Route::middleware(['isAdmin','auth'])->group(function(){
    Route::get('/dashboard', 'Admin\HomeController@index');
    Route::get('/Admin-Product', 'Admin\ProductController@index');
    Route::get('/Add-Product', 'Admin\ProductController@add');
    Route::post('/insert-product', 'Admin\ProductController@insert');
    Route::get('/product-remove/{id}', 'Admin\ProductController@remove');
    Route::get('/product-edit/{id}', 'Admin\ProductController@edit');
    Route::put('/update-product/{id}', 'Admin\ProductController@update');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('layout');

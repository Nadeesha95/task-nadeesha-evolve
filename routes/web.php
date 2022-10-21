<?php

use App\Http\Controllers\Product_controller;
use App\Http\Controllers\Seller_controller;
use Illuminate\Support\Facades\Route;

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

Route::resource('/',Seller_controller::class);
Route::resource('seller',Seller_controller::class);
Route::get('product/{id}',[Product_controller::class, 'show']);
Route::get('showseller/{id}',[Seller_controller::class, 'showseller']);



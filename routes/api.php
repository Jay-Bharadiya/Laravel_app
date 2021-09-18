<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Category\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('buyers', "App\Http\Controllers\Buyer\BuyerController",["only"=>['index','show']]);
Route::resource('categories', "App\Http\Controllers\Category\CategoryController",["except"=>['create','edit']]);
Route::resource('products', "App\Http\Controllers\Product\ProductController",["only"=>['index','show']]);
Route::resource('transactions', "App\Http\Controllers\Transaction\TransactionController",["only"=>['index','show']]);
Route::resource('sellers', "App\Http\Controllers\Seller\SellerController",["only"=>['index','show']]);
Route::resource('users', "App\Http\Controllers\User\UserController",["except"=>['create','edit']]);


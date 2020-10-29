<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signup');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');


});
Route::get('all_users', 'Api\AuthController@all_users');


Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/typology', 'Api\TypologyController');
Route::apiResource('/product', 'Api\ProductController');

Route::get('add_to_cart/{id}', 'Api\CartController@add_to_cart')->name('add_to_cart');
Route::get('product_cart', 'Api\CartController@product_cart')->name('product_cart');
Route::get('remove_product_cart/{id}', 'Api\CartController@remove_product_cart')->name('remove_product_cart');
Route::get('increment/{id}', 'Api\CartController@increment')->name('increment');
Route::get('decrement/{id}', 'Api\CartController@decrement')->name('decrement');

Route::get('get_product/{id}', 'Api\PosController@get_product')->name('get_product');
Route::post('order_done', 'Api\PosController@order_done')->name('order_done');

// Admin Dashboard
Route::get('sales_today', 'Api\DashboardController@sales_today');
Route::get('sales_this_month', 'Api\DashboardController@sales_this_month');
Route::get('sales_this_year', 'Api\DashboardController@sales_this_year');
Route::get('all_sales', 'Api\DashboardController@all_sales');
Route::get('stockout', 'Api\DashboardController@stockout');


// Order Route
Route::get('today_orders', 'Api\OrderController@today_orders');
Route::get('order/{id}', 'Api\OrderController@order');
Route::get('order_details/{id}', 'Api\OrderController@order_details');
Route::post('search_order_date', 'Api\OrderController@search_order_date');


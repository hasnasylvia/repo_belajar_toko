<?php

use Illuminate\Http\Request;

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
Route::post('/register','UserController@register');
Route::post('/login','UserController@login');

Route::group(['middleware'=>['jwt.verify']],function(){
    Route::get('/costumer', 'CostumerController@show');
    Route::post('/costumer', 'CostumerController@store');
    Route::delete('/costumer/{id_costumer}', 'CostumerController@destroy');

    Route::get('/product', 'ProductController@show');
    Route::post('/product', 'ProductController@store');
    Route::delete('/product/{id_product}', 'ProductController@destroy');

    Route::get('/order', 'OrderController@show');
    Route::get('/order/{id}', 'OrderController@detail');
    Route::post('/order', 'OrderController@store');
    Route::put('/order/{id}', 'OrderController@update');
    Route::delete('/order/{id}', 'OrderController@destroy');
});
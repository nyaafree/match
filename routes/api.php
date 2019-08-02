<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AxiosController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function(){
    Route::post('category', 'AxiosController@category');
    Route::post('comment','CommentsController@comment');
    Route::delete('item/{id}', 'AxiosController@delete');
    Route::get('items', 'AxiosController@index');
    Route::patch('comment/{id}', 'AxiosController@comment');
    Route::post('fetch/{id}', 'AxiosController@fetch');
    Route::delete('comment/{id}', 'AxiosController@destroy');
    Route::post('all/comments/{id}', 'AxiosController@all');
    Route::patch('message/{id}', 'AxiosController@message');
    Route::post('message/update/{id}', 'AxiosController@messageUpdate');
    Route::delete('message/{id}', 'AxiosController@messageDelete');
    Route::post('all/messages/{id}', 'AxiosController@allMessages');
});

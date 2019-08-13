<?php

use App\Category;
use Illuminate\Support\Facades\Auth;

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

Route::get('/','HomeController@index');

Auth::routes();

Route::get('/mypage','mypageController@index');

Route::resources(['profile'=>'profileController']);
Route::resources(['items'=>'ItemController']);
Route::resources(['comments'=>'CommentsController']);

Route::post('comments/{id}','CommentsController@comment')->name('comment');
Route::post('apply/{id}', 'ApplyItemController@store');

Route::get('board/{id}','ApplyItemController@show')->name('board');
Route::post('message/{id}','MessagesController@message')->name('message');
// Route::get('mypage/quit','mypageController@quit');

Route::get('search','HomeController@filter')->name('search');




Route::get('/home', 'HomeController@index')->name('home');

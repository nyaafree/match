<?php

use App\Category;

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

Route::resources(['/profile'=>'profileController']);
Route::resources(['/items'=>'ItemController']);
Route::resources(['/comments'=>'CommentsController']);

Route::post('/comments/{id}','CommentsController@comment')->name('comment');





Route::get('/home', 'HomeController@index')->name('home');

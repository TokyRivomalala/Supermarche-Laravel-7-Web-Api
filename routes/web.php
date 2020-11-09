<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'AdminController@index')->name('login');
Route::post('/checkLogin', 'AdminController@checkLogin')->name('check login');
Route::get('/article', 'ArticleCompletController@select')->name('allArticle');
Route::post('/newArticle', 'ArticleController@insert')->name('newArticle');
Route::get('/article/delete/{id}', 'ArticleController@delete')->name('deleteArticle');
Route::get('/article/update/{id}', 'ArticleController@update')->name('updateArticle');
Route::post("/modifierArticle", 'ArticleController@modifier')->name('modifierArticle');

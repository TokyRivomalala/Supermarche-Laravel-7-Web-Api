<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Route::post('/deconnexion', 'AdminController@deconnexionApi')->name('deconnexion');
// Route::post('/checkLogin', 'AdminController@checkLoginApi')->name('check login');
// Route::get('/article', 'ArticleCompletController@selectApi')->name('allArticle');
// Route::post('/newArticle', 'ArticleController@insertApi')->name('newArticle');
// Route::delete('/article/delete/{id}', 'ArticleController@deleteApi')->name('deleteArticle');
// Route::post("/modifierArticle", 'ArticleController@modifierApi')->name('modifierArticle');

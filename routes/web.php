<?php

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

Route::get('/', 'HomeController@index');
Route::match(['get', 'post'], '/search/{categoryId?}','HomeController@search');

Route::get('/info/{id}', 'HomeController@info');
Route::resource('comment', 'HomeController');

Auth::routes();

Route::get('/logout', function () {
    return view('/admin');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {

    Route::get('/', 'HomeController@index');
    Route::resource('categories', 'CategoryController');
    Route::resource('articles', 'ArticleController');
    Route::resource('tags', 'TagController');
    Route::resource('personal', 'UserController');

});

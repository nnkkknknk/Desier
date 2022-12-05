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

Route::get('/', 'WorksController@index')->name('top');
Auth::routes();

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


Route::get('adminlogin', 'Auth\LoginController@showadminLoginForm')->name('adminlogin');
Route::post('adminlogin', 'Auth\LoginController@adminLogin')->name('adminlogin.post');
Route::get('/admin/logout', 'Auth\LoginController@adminLogout')->name('admin.logout');
Route::get('/admin/dashboard','Auth\LoginController@admindashboard')->name('admindashboard');
Route::delete('works/{id}/admindelete', 'WorksController@admindestroy')->name('work.admindelete');


// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// Route::resource('works', 'WorksController');
Route::resource('works', 'WorksController', ['expect' => ['edit', 'update']]);
// Route::resource('users', 'UsersController', ['expect' => ['index', 'create','store','destroy']]);
Route::resource('users', 'UsersController', ['only' => ['show']]);
// Route::resource('users', 'UsersController');
Route::group(['prefix' => 'works/{id}'], function () {
    Route::get('download', 'WorksController@download')->name('work.download');
 });
Route::post('search', 'WorksController@search')->name('work.search');
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
    });
    
    // 追加
    Route::group(['prefix' => 'works/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
        Route::post('comment', 'CommentController@store')->name('comments.store');
    });
    
    Route::resource('works', 'WorksController', ['only' => ['store', 'destroy', 'create',]]);
    Route::resource('users', 'UsersController', ['only' => ['edit', 'update']]);
    
    
});
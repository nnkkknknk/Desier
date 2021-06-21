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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'WorksController@index')->name('top');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::resource('works', 'WorksController');
Route::group(['prefix' => 'works/{id}'], function () {
    Route::get('download', 'WorksController@download')->name('work.download');
 });
Route::group(['middleware' => ['auth']], function () {
    
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        Route::get('post', 'UsersController@post')->name('users.post');
        
        Route::get('favoritings', 'UsersController@favoritings')->name('users.favoritings');
    });
    
    // 追加
    Route::group(['prefix' => 'works/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
    
    Route::resource('works', 'WorksController', ['only' => ['store', 'destroy', 'create']]);
    // Route::resource('works', 'TagsController', ['only' => ['store', 'destroy']]);
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);
    
    
});
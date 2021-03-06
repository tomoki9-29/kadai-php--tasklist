<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'TasklistsController@index');

// ユーザ登録
Route::get('signup', 'Auth\AuthController@getRegister')->name('signup.get');
Route::post('signup', 'Auth\AuthController@postRegister')->name('signup.post');

//ログイン機能
Route::get('login', 'Auth\AuthController@getLogin')->name('login.get');
Route::post('login', 'Auth\AuthController@postLogin')->name('login.post');
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout.get');

//↑上記を下記のように書き換える
//Route::get('/','TasklistsController@index');

/*
//1.先にCRUDメソッドを書いてしまう
Route::get('tasklists/{id}','TasklistsController@show');tasklists→tasks〇
Route::post('tasklists','TasklistsController@store');
Route::put('tasklists/{id}','TasklistsController@update');
Route::delete('tasklist/{id}','TasklistsController@delete');

//2.UserがWeb上で操作するためのルーティングを追加する(補助機能)
Route::get('tasklists','TasklistsController@index');
Route::get('tasklists/create','TasklistsController@create');
Route::get('tasklists/{id}/edit','TasklistsController@edit');
*/

//↑これらの7つのルーティングは以下のルーティングと同じ意味になる
//Route::resource('tasklists','TasklistsController');


//['middleware' => 'auth'] を加えることで、このグループに書かれたルーティングは必ずログイン認証を確認させます。
Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::resource('tasklists', 'TasklistsController');
});
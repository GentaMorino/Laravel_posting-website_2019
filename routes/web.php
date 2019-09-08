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
/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', function () {
    return view('story.index');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix'=>'story'],function(){
    //TOP
    Route::get('/', 'Story\StoriesController@index');//->middleware('auth');
});

Route::group(['prefix'=>'user'],function(){
    //アカウント管理
    Route::get('/', 'User\UsersController@index')->middleware('auth');
    Route::get('/edit', 'User\UsersController@edit')->middleware('auth');
    Route::post('/edit','User\UsersController@update')->middleware('auth');;  
});

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


Route::get('/', 'Story\StoriesController@index'); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix'=>'story'],function(){
    //TOP
    Route::get('/index', 'Story\StoriesController@index');//->middleware('auth');
    //記事を見る
    Route::get('/detail','Story\StoriesController@detail');
    //記事追加
    Route::get('/add','Story\StoriesController@add')->middleware('auth');
    Route::post('/add','Story\StoriesController@create')->middleware('auth');
    //記事編集
    Route::get('/edit','Story\StoriesController@edit')->middleware('auth');
    Route::post('/edit','Story\StoriesController@update')->middleware('auth');
    //記事削除
    Route::post('/delete','Story\StoriesController@delete')->middleware('auth');
    //記事管理
    Route::get('/manage','Story\StoriesController@manage')->middleware('auth');
    //タブ追加
    Route::post('/manage','Story\StoriesController@tab')->middleware('auth');
    //タブ削除
    Route::post('/delete-tab','Story\StoriesController@deleteTab')->middleware('auth');
    //個人ページ閲覧
    Route::get('/personal','Story\StoriesController@personal');

    
});

Route::group(['prefix'=>'user'],function(){
    //アカウント管理
    Route::get('/index', 'User\UsersController@index')->middleware('auth');
    Route::get('/edit', 'User\UsersController@edit')->middleware('auth');
    Route::post('/edit','User\UsersController@update')->middleware('auth');
    Route::post('/delete','User\UsersController@delete')->middleware('auth');
});

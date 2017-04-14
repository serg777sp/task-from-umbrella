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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','PageController@index');
Route::get('/links', 'PageController@Links');
Route::get('/link/add', 'LinkController@addLink');
Route::get('/link/check', 'LinkController@checkLink');
Route::get('/link/short/check', 'LinkController@checkShortUrl');

Route::post('/link/add', 'LinkController@storeLink');

Route::group(['middleware' => 'redirect'], function(){
    Route::get('/{short}', function($short){
	return redirect('/'.$short);
    });
});


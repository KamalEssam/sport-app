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
$date = date('Y-m-d');
Route::get('/home', function() use($date) { return redirect('/admin/matches?date='.$date); });
Route::get('/admin', function() use($date){ return redirect('/admin/matches?date='.$date); });

Route::group(['namespace' => 'App'], function()
{
    Route::get('/', function(){ return view('app.home'); });
    Route::get('/featured', function(){ return view('app.home-outer'); });
    Route::get('/home-inner', 'HomeController@index');
    Route::get('/matches/{matche}', 'LiveController@show');
    Route::get('/channels/{channel}', 'LiveController@showChannel');
    Route::get('/iframe-inner/{server}', 'LiveController@iframeInner');
    Route::get('/iframe-outer/{server}', 'LiveController@iframeOuter');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function()
{
    Auth::routes();
    Route::resource('/matches', 'MatchController');
    Route::resource('/leagues', 'LeagueController');
    Route::resource('/channels', 'ChannelController');
    Route::resource('/servers-types', 'ServerTypeController');
    Route::patch('/servers/{server}/status', 'ServerController@status');
    Route::patch('/servers/{server}/featured', 'ServerController@featured');
    Route::patch('/servers/{server}/adblock', 'ServerController@adblock');
    Route::resource('/servers', 'ServerController');
    Route::resource('/admins', 'AdminController');
    Route::get('/adsenses', 'AdsenseController@edit');
    Route::put('/adsenses', 'AdsenseController@update');
});
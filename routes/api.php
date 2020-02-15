<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'v1', 'namespace' => 'API', 'middleware' => 'forceUpdate'], function () 
{  
    // AUTH
    Route::group(['prefix' => 'auth'], function()
    {
        // LOGIN & SIGNUP
        Route::post('/login','AuthController@login');
        Route::post('/signup','AuthController@signup');
        // REFRESH TOKENS
        Route::post('/token/refresh','AuthController@refreshJWTToken');
        Route::post('/fcm/refresh','AuthController@refreshFCMToken');
        // RESET PASSWORD
        Route::post('/reset/password','AuthController@sendResetCode');
        Route::post('/reset/password/resend','AuthController@resendResetCode');
        Route::post('/reset/password/confirm','AuthController@confirmResetCode');
        Route::post('/reset/password/update','AuthController@updatePassword');
        // SOCIAL LOGIN
        Route::post('login/facebook', 'AuthController@socialLogin');
    });

    // LEAGUES WITH MATCHES
    Route::get('/matches','MatchController@index');
    // LEAGUES
    Route::get('/leagues','LeagueController@index');
    Route::get('/leagues/{league}','LeagueController@show');
    //POSTS
    Route::get('/posts','PostController@index');
    // CHATS
    Route::get('/chats', 'ChatController@index');

    // PRTOTECTED ROUTES
    Route::group(['middleware' => 'auth:api'], function()
    {
        // AUTH
        Route::post('/auth/logout','AuthController@logout');
        // POSTS
        Route::post('/posts/{post}/likes', 'PostController@like');
        // COMMENTS
        Route::post('/posts/{post}/comments', 'CommentController@store');
        // COMMENTS LIKES
        Route::post('/posts/{post}/comments/{comment}/likes', 'CommentController@like');
        // USER
        Route::put('/users', 'UserController@update');
    });

});

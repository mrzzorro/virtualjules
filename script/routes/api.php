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

// API V1 Routes
Route::prefix('v1')->namespace('Api')->group(function () {
    Route::post('/register', 'AuthController@register')->name('api.register');
    Route::post('/login', 'AuthController@login')->name('api.login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'AuthController@logout')->name('api.logout');
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('api.user');
    });

    // Video Routes
    Route::get('/videos', 'VideoController@index')->name('api.videos.index');
    Route::get('/videos/{slug}', 'VideoController@show')->name('api.videos.show');
    Route::post('/videos', 'VideoController@store')->name('api.videos.store');

    // Photo Routes
    Route::get('/photos', 'PhotoController@index')->name('api.photos.index');
    Route::get('/photos/{slug}', 'PhotoController@show')->name('api.photos.show');
    Route::post('/photos', 'PhotoController@store')->name('api.photos.store');

    // User Profile Route
    Route::get('/users/{slug}', 'UserController@show')->name('api.users.show');

    // Comment Routes
    Route::get('/videos/{video}/comments', 'CommentController@indexVideo')->name('api.videos.comments.index');
    Route::post('/videos/{video}/comments', 'CommentController@storeVideo')->name('api.videos.comments.store');
    Route::get('/photos/{photo}/comments', 'CommentController@indexPhoto')->name('api.photos.comments.index');
    Route::post('/photos/{photo}/comments', 'CommentController@storePhoto')->name('api.photos.comments.store');

    // Like Routes
    Route::post('/videos/{video}/like', 'LikeController@storeVideo')->name('api.videos.like');
    Route::delete('/videos/{video}/like', 'LikeController@destroyVideo')->name('api.videos.unlike');
    Route::post('/photos/{photo}/like', 'LikeController@storePhoto')->name('api.photos.like');
    Route::delete('/photos/{photo}/like', 'LikeController@destroyPhoto')->name('api.photos.unlike');

    // video embed api
    Route::get('/video_embed/{slug}','EmbedController@embed')->name('api.video.embed');
});

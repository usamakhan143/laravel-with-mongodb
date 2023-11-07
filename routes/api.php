<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/getPosts', 'App\Http\Controllers\Apis\PostController@get_posts');
Route::post('/createPost', 'App\Http\Controllers\Apis\PostController@create_post');
Route::put('/updatePost/{id}', 'App\Http\Controllers\Apis\PostController@update_post');
Route::get('/deletePost/{id}', 'App\Http\Controllers\Apis\PostController@delete_post');


Route::get('/test', function () {
    $con = DB::connection('mongodb');
    $msg = 'Connection is Active';
    try {
        $con->command(['ping' => 1]);
    } catch (\Exception $e) {
        $msg = 'Connect is not Active. Error: ' . $e->getMessage();
    }
    return ['message' => $msg];
});

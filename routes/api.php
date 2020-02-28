<?php

use App\User;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::apiResource('users', 'Api\UserController');

Route::post('login', function (Request $request) {
    $token = User::find(1)->createToken('personal');

    return $token->plainTextToken;
});

Route::middleware('auth:airlock')->get('/user', function (Request $request) {
    return $request->user();
});

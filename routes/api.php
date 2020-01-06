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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('user','Users\UsersController');
Route::apiResource('userprofile','Users\UserProfileController');
Route::apiResource('userlog','Users\UserLogController');
Route::apiResource('OfficePosition','Chat\OfficePositionController');
Route::apiResource('chattype','Chat\ChatTypeController');
Route::apiResource('chatpermission','Chat\ChatPermissionController');
Route::apiResource('chatp2p','Chat\ChatP2PController');
Route::apiResource('chatgroupusers','Chat\ChatGroupUsersController');
Route::apiResource('chatgroupconversion','Chat\ChatGroupConversionController');
Route::apiResource('chatgroup','Chat\ChatGroupController');


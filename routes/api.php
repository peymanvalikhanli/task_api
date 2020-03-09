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

Route::post('Register', 'Users\globalController@register');
Route::post('Login', 'Users\globalController@login');
Route::post('RecoveryPass', 'Users\globalController@recovery_pass'); 
Route::post('ChangePass', 'Users\globalController@change_pass'); 
Route::post('Contact', 'Users\globalController@contact_list'); 
Route::post('ChatHistory', 'Chat\globalController@chat_history'); 
Route::post('ChatList', 'Chat\globalController@chat_list'); 
Route::post('GroupList', 'Chat\globalController@group_list'); 
Route::post('CreateGroup', 'Chat\globalController@create_group'); 
Route::post('GroupHistory', 'Chat\globalController@group_history'); 
Route::post('SendMessage', 'Chat\globalController@send_message'); 
Route::post('SendMessageGroup', 'Chat\globalController@send_message_group'); 
Route::post('DeleteMessage', 'Chat\globalController@delete_message'); 
Route::post('DeleteMessageGroup', 'Chat\globalController@delete_message_group'); 
Route::post('SendFileChat', 'Chat\globalController@send_file_chat');

//chanel auth
Route::post('auth', 'users\globalController@auth');





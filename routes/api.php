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

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    //User
    Route::post('/login', 'ManagerAuthApi@login');
    Route::post('/register', 'ManagerAuthApi@register');


    //Group
    Route::get('/groups', 'ManagerGroupApi@index');
    Route::post('/groups', 'ManagerGroupApi@create');
    Route::patch('/groups/{id}', 'ManagerGroupApi@edit');
    Route::get('/groups/ByGroupId/{id}', 'ManagerGroupApi@getMemberByGroupId');


    //Chat
    Route::post('/chats', 'ManagerChatApi@create');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

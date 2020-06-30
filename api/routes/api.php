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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function($router){
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

// Route::apiResource('clients', 'User/ClientController');
// Route::get('/clients/archived/all', 'User/ClientController@retrieveDeleted');
// Route::get('clients/restore/{id}', 'User/ClientController@restoreHousehold');
// Route::get('clients/delete/{id}', 'User/ClientController@forceDestroy');

// Route::apiResource('surveyors', 'User/UserController');
// Route::get('/surveyors/archived/all', 'User/UserController@retrieveDeleted');
// Route::get('surveyors/restore/{id}', 'User/UserController@restoreHousehold');
// Route::get('surveyors/delete/{id}', 'User/UserController@forceDestroy');

// Route::apiResource('users', 'User/UserController');
// Route::get('/users/archived/all', 'User/UserController@retrieveDeleted');
// Route::get('users/restore/{id}', 'User/UserController@restoreHousehold');
// Route::get('users/delete/{id}', User/'UserController@forceDestroy');

Route::group([
    'prefix' => 'users'
], function () {
    Route::apiResource('/clients', 'User\ClientController');
    Route::get('/clients/archived/all', 'User\ClientController@retrieveDeleted');
    Route::get('clients/restore/{id}', 'User\ClientController@restoreClient');
    Route::get('clients/delete/{id}', 'User\ClientController@forceDestroy');

    Route::apiResource('/users', 'User\UserController');
    Route::get('/users/archived/all', 'User\UserController@retrieveDeleted');
    Route::get('users/restore/{id}', 'User\UserController@restoreUser');
    Route::get('users/delete/{id}', 'User\UserController@forceDestroy');
});

Route::apiResource('surveyors', 'User\SurveyorController');
Route::get('/surveyors/archived/all', 'User\SurveyorController@retrieveDeleted');
Route::get('surveyors/restore/{id}', 'User\SurveyorController@restoreSurveyor');
Route::get('surveyors/delete/{id}', 'User\SurveyorController@forceDestroy');
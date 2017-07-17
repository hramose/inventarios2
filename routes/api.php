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

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes
});

// http://www.expertphp.in/article/api-authentication-using-jwt-in-laravel-5-4-tutorial-with-example
Route::post('auth/register', 'UserApiController@register');
Route::post('auth/login', 'UserApiController@login');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user', 'UserApiController@getAuthUser');
});




Route::resource('informe_manto_pre', 'InformeMantenimientoPreventivoApiController',
    ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
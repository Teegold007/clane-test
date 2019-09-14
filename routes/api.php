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


$router->group(['prefix' => '/v1'], function () use ($router) {

    /*********************************************************
     *  GENERAL ROUTES (UN-AUTH)
     ********************************************************/
    $router->post('login', 'Auth\LoginController@login');


    $router->group(['prefix' => '/auth'], function () use ($router) {
        //logout
        $router->post('logout', 'Auth\LoginController@logout');


        });




});




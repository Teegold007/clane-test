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



$router->group(['prefix' => '/v1'], function () use ($router) {

    /*********************************************************
     *  GENERAL ROUTES (UN-AUTH)
     ********************************************************/
    $router->post('login', 'Auth\LoginController@login');
    $router->get('articles', 'ArticleController@index');
    $router->get('articles/{article}', 'ArticleController@show');
    $router->post('/articles/{id}/rating', 'ArticleController@rateArticles');



    $router->group(['prefix' => '/auth','middleware' => 'auth:api'], function () use ($router) {
        //logout
        $router->post('logout', 'Auth\LoginController@logout');
        $router->post('articles', 'ArticleController@store');
        $router->put('articles/{id}', 'ArticleController@update');
        $router->post('articles/{id}', 'ArticleController@delete');


        });




});




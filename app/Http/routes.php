<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});


//API版本1
$app->group(['namespace' => 'App\Http\Controllers\V1'], function() use ($app)
{
    //用户登录
    $app->post('user/login', 'UsersController@Login');

    //用户信息
    $app->get('user/info/{id}', 'UsersController@Info');

});
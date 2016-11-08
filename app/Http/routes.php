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

//用户登录
$app->post('user/login', 'UsersController@Login');

//用户注册
$app->post('user/register', 'UsersController@Register');

//用户信息查询
$app->get('user/info', [ 'middleware' => 'authToken', 'uses' => 'UsersController@Info']);


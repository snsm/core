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
    //用户登录区--------------
    $app->post('user/login', 'UsersController@Login');
    //用户信息
    $app->post('user/show', [ 'middleware' => 'authToken', 'uses' => 'UsersController@Show']);
    //用户更新
    $app->post('user/update', [ 'middleware' => 'authToken', 'uses' => 'UsersController@Update']);
    //用户删除
    $app->post('user/delete', [ 'middleware' => 'authToken', 'uses' => 'UsersController@Delete']);
    //创建用户
    $app->post('user/store', [ 'middleware' => 'authToken', 'uses' => 'UsersController@Store']);
    //用户退出
    $app->post('user/logout', [ 'middleware' => 'authToken', 'uses' => 'UsersController@Logout']);

    //组织目录区--------------
    $app->post('tissue/index', [ 'middleware' => 'authToken', 'uses' => 'TissuesController@Index']);
    //创建组织
    $app->post('tissue/create', [ 'middleware' => 'authToken', 'uses' => 'TissuesController@Create']);
    //更新组织列表
    $app->post('tissue/update', [ 'middleware' => 'authToken', 'uses' => 'TissuesController@Update']);

});
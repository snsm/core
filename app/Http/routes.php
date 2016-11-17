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

//API版本1
$app->group(['namespace' => 'App\Http\Controllers\V1'], function() use ($app)
{
    //系统用户登录区--------------

    //用户登录
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

    //公司组织架构目录区--------------

    //显示所有公司组织架构列表
    $app->post('tissue/index', [ 'middleware' => 'authToken', 'uses' => 'TissuesController@Index']);
    //创建新增公司组织架构
    $app->post('tissue/create', [ 'middleware' => 'authToken', 'uses' => 'TissuesController@Create']);
    //更新公司组织架构
    $app->post('tissue/update', [ 'middleware' => 'authToken', 'uses' => 'TissuesController@Update']);
    //删除公司组织架构
    $app->post('tissue/delete', [ 'middleware' => 'authToken', 'uses' => 'TissuesController@Delete']);

    //保险公司目录区--------------

    $app->post('company/index', [ 'middleware' => 'authToken', 'uses' => 'CompanysController@Index']);
    //创建新增保险公司类型
    $app->post('company/create-company-type', [ 'middleware' => 'authToken', 'uses' => 'CompanysController@createCompanyType']);
    //更新保险公司类型
    $app->post('company/update-company-type', [ 'middleware' => 'authToken', 'uses' => 'CompanysController@updateCompanyType']);
    //删除保险公司类型
    $app->post('company/delete-company-type', [ 'middleware' => 'authToken', 'uses' => 'CompanysController@deleteCompanyType']);

    //创建保险险种栏目
    $app->post('company/create-insurance', [ 'middleware' => 'authToken', 'uses' => 'CompanysController@createInsurance']);

});
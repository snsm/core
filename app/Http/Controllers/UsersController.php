<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{

    public function index()
    {

    }

    public function login()
    {

    }

    public function register()
    {
        return 'ok';
    }

    public function store(Request $request)
    {
        //1、验证
        $validator = \Validator::make($request->input(), [
            'mobile' => 'required|unique:users',
            'password' => 'required',
        ]);

        //2、判断验证是否正确
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'status_code' => '404',
                'data' => '该手机号已被他人注册'
            ]);
        }

        //3、接受参数并且保存数据
        User::create([
            'mobile' => $request->get('mobile'),
            'password' => app('hash')->make($request->get('password')),
        ]);

        return redirect('user/register');
    }
}
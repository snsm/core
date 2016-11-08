<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User;
use Auth;

class UsersController extends Controller
{

    private $salt;

    public function __construct()
    {
        $this->salt="userloginregister";
    }

    //用户登录
    public function Login(Request $request)
    {
        if ($request->has('mobile') && $request->has('password')) {

            $user = User::where("mobile", "=", $request->input('mobile'))->where("password", "=", sha1($this->salt.$request->input('password')))->first();

            if ($user) {

                $token=str_random(60);
                $user->api_token=$token;
                $user->save();

                return response()->json([
                    'status' => 'ok',
                    'data' => $user->api_token
                ]);

            } else {

                return response()->json([
                    'status' => 'failed',
                    'status_code' => '404',
                    'data' => '用户名或密码不正确，登录失败！'
                ]);

            }

        } else {
            return response()->json([
                'status' => 'failed',
                'status_code' => '404',
                'data' => '登录信息不完整，请输入用户名和密码登录！'
            ]);
        }
    }

    //用户注册
    public function Register(Request $request)
    {
        if ($request->has('mobile') && $request->has('password')) {

            $user = new User;
            $user->mobile=$request->input('mobile');
            $user->password=sha1($this->salt.$request->input('password'));
            $user->api_token=str_random(60);

            if($user->save()){

                return response()->json([
                    'status' => 'ok',
                    'data' => '用户注册成功！'
                ]);

            } else {

                return response()->json([
                    'status' => 'failed',
                    'status_code' => '404',
                    'data' => '用户注册失败！'
                ]);

            }

        } else {

            return response()->json([
                'status' => 'failed',
                'status_code' => '404',
                'data' => '请输入完整用户信息！'
            ]);

        }
    }

    //用户信息查询
    public function Info()
    {
        dd(Auth::user());
       // return Auth::user();
    }

}
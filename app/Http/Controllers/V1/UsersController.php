<?php

namespace App\Http\Controllers\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Auth;
use Cache;


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

            $user = User:: where("mobile", "=", $request->input('mobile'))->where("password", "=", sha1($this->salt.$request->input('password')))->first();

            if ($user) {
                $token=str_random(60);
                Cache::add($token,$user,5);

                return response()->json([
                    'status' => 'ok',
                    'token' => $token
                ]);

            } else {
                return response()->json([
                    'data' => '用户名或密码不正确，登录失败！'
                ]);
            }

        } else {
            return response()->json([
                'data' => '登录信息不完整，请输入用户名和密码登录！'
            ]);
        }
    }

    //用户信息
    public function Info(Request $request)
    {
        return Cache::get();

       //return sha1($this->salt.'123456');
    }

    //用户更新
    public function Update(Request $request)
    {

    }

    //用户删除
    public function Delete(Request $request)
    {

    }

}
<?php

namespace App\Http\Controllers\V1;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

use App\User;
use Auth;
use Cache;

use App\Transformer\UserTransformer;

class UsersController extends ApiController
{
    protected $UserTransformer;
    private $salt;

    public function __construct(UserTransformer $UserTransformer)
    {
        $this->UserTransformer = $UserTransformer;
        $this->salt="userloginregister";
    }

    //用户登录
    public function Login(Request $request)
    {
        if ($request->has('mobile') && $request->has('password')) {
            $user = User:: where("mobile", "=", $request->input('mobile'))->where("password", "=", sha1($this->salt.$request->input('password')))->first();
            if ($user) {
                $tokenVerify = [
                    'token'=>str_random(60),
                    'user'=>$user,
                ];
                Cache::add('token',$tokenVerify,30);
                return $this->setStatusCode(201)->response([
                    'status' => 'success',
                    'token' => $tokenVerify['token'],
                    'data' => $user->toArray()
                ]);
            } else {
                return $this->setStatusCode(422)->responseError('用户名或密码不正确，登录失败！');
            }
        } else {
            return $this->setStatusCode(422)->responseError('登录信息不完整，请输入用户名和密码登录！');
        }
    }

    //用户退出
    public function logout(){
        Cache::flush();
        return redirect('/');
    }

    //用户信息
    public function Show()
    {
        $user = User::all();
        return $this->response([
            'status' => 'success',
            'data' => $this->UserTransformer->transformCollection($user->toArray())
        ]);
    }

    //用户更新
    public function Update(Request $request)
    {
        $user = User::find($request->input('id'));
        if(!$user){
            return $this->responseNotFount();
        }
        $user->name = $request->input('name');
        $user->password = sha1($this->salt.$request->input('password'));
        $user->status = $request->input('status');
        $user->save();
        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'data' => $user->toArray()
        ]);
    }

    //用户删除
    public function Delete($id)
    {
        if(!$user = User::find($id)){
            return $this->responseNotFount();
        }
        $user->delete();
        return $this->setStatusCode(200)->response([
            'status' => 'success',
            'massage' => '删除成功！'
        ]);
    }

    //创建用户
    public function Store(Request $request)
    {
        //1、验证
        $validator = \Validator::make($request->input(), [
            'name' => 'required',
            'mobile' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        //2、判断验证是否正确
        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError('该手机号已被他人注册');
        }

        //3、接受参数并且保存数据
       $user = User::create([
            'name' => $request->get('name'),
            'mobile' => $request->get('mobile'),
            'status' => $request->get('status'),
            'password' => sha1($this->salt.$request->input('password')),
        ]);

        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'data' => $user->toArray()
        ]);
    }

}
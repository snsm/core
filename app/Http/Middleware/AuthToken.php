<?php
namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
use App\Http\Controllers\ApiController;

class AuthToken
{
    public function handle($request, Closure $next)
    {
        if(Cache::get('token')){
            if(Cache::get('token')['token'] != $request->input(['accessToken'])){
                return (new ApiController())->responseNotFount('用户访问该资源,assessToken错误或过期，请求失败',422);
            }
            return $next($request);

        }else{
            return redirect('/');
        }

       /* if(Auth::check()){
            return $next($request);
        }else{
            abort(401);
        }*/
    }
}
<?php
namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;

class AuthToken
{
    public function handle($request, Closure $next)
    {
        $value = Cache::get('token');
        if($value['token']){
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
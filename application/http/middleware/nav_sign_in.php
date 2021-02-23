<?php

namespace app\http\middleware;
//进行登录检查,未登录重定向到登录页面
use think\Cache;
use think\Log;
use think\Request;
use think\Response;
use think\response\Redirect;

class nav_sign_in
{
    public function handle($request, \Closure $next)
    {
        if (array_key_exists('HTTP_X_TOKEN', $_SERVER)) {
            $token = $_SERVER['HTTP_X_TOKEN'];
            if (\think\facade\Cache::has($token)) {
                $request->user = json_decode(\think\facade\Cache::get($token));

            } else {
               return new Response('request forbidden', '403');
            }


        } else {
           return new Response('request forbidden', '403');

        }
        return $next($request);
    }
}

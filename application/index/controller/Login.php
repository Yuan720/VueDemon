<?php


namespace app\index\controller;


use app\common\beans\WebResponse;
use app\index\modle\User;
use think\Cache;
use think\Request;
use think\Validate;

class Login
{
    function login(Request $request){
        $user_name=$request->param('name');
        $user_psw= $request->param('paw');
        $validate = new Validate(['name|用户名'  => 'require', 'passwd|密码' => 'require']);
        $userIput=['name'=>$user_name,'passwd'=>$user_psw];
        if (!$validate->check($userIput)){
            return WebResponse::faield('',403,$validate->getError());
        }
        $user=User::where('username',$user_name)->find();
     if (!is_null($user)){
         if ($user->hashedPassWd==$user_psw){
             $token=  $token=$this->uniqidReal(16);
             \think\facade\Cache::set($token,json_encode($user));
             return WebResponse::success($token);
         }else{
             return WebResponse::faield('',400,'用户名或者密码错误');
         }
     }else{

         return WebResponse::faield('',400,'用户名或者密码错误');
     }

    }


     /**
     * 生成唯一的uuid值
     * @param  integer $lenght 生成的uuid长度
     * @return
     */
    private  function uniqidReal($lenght = 13)
    {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }

}

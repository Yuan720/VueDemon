<?php


namespace app\common\beans;


class WebResponse
{   public static function success($data,$code=200,$msg=''){
    $newResponse=new WebResponse();
    $newResponse->status='success';
    $newResponse->code=$code;
    $newResponse->msg=$msg;
    $newResponse->data=$data;
    return json($newResponse);
}
    public static function faield($data,$code=500,$msg=''){
        $newResponse=new WebResponse();
        $newResponse->status='error';
        $newResponse->code=$code;
        $newResponse->msg=$msg;
        $newResponse->data=$data;
        return json($newResponse);
    }
    public $code;
    public $status;
    public $msg;
    public $data;


}

<?php


namespace app\index\controller;


use app\common\beans\WebResponse;
use app\index\modle\ProductItemM;
use think\Controller;
use think\Db;
use think\db\Where;
use think\Request;

class Item extends Controller
{
    protected $middleware = ['nav_sign_in'];

    function queryByKeyWords(Request $request)
    {
        $query = $request->param('keywords');
        $result = Db::table('product_logs')->where('product_id|name|create_user|id', 'like', '%' . $query . '%')->select();
        return WebResponse::success($result);

    }

    function addItem(Request $request)
    {
        $item = new ProductItemM();
        $id = $request->param('id');
        $name = $request->param('name');
        $item_no = $request->param('item_no');
        $item->id = $id;
        $item->name = $name;
        $item->product_id = $item_no;
        $item->create_user = $request->user->username;
        $result = $item->save();
        if ($result) {
            $item->add_time = date('Y-m-d H:i:s');
            return WebResponse::success($item);
        } else {
            return WebResponse::faield('');
        }


    }

    function removeItem(Request $request)
    {
        $id = $request->param('id');
        $item = ProductItemM::get($id);
        if ($item) {
            $excute = $item->delete();
            if ($excute) {
                return WebResponse::success($excute);
            }
        } else {
            return WebResponse::faield('');
        }


    }

}

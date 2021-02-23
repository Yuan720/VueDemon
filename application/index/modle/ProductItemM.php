<?php
/*
 *
 *
create table product_logs
(
    id          int auto_increment,
    name        varchar(50)                        null,
    product_id  varchar(25)                        null,
    add_time    datetime default CURRENT_TIMESTAMP not null,
    create_user varchar(12)                        null,
    constraint id
        unique (id)
);



 * */

namespace app\index\modle;


class ProductItemM extends \think\Model
{
    protected $table = 'product_logs';

//    public function searchIdAttr($query, $value, $data)
//    {
//        $query->where('id', 'like', '%'.$value . '%');
//    }
//
//    public function searchProduct_idAttr($query, $value, $data)
//    {
//        $query->where('product_id', 'like','%'. $value . '%');
//    }
//
//    public function searchNameAttr($query, $value, $data)
//    {
//        $query->where('name', 'like', '%'.$value . '%');
//    }
//
//    public function searchAdd_timeAttr($query, $value, $data)
//    {
//        $query->where('add_time', 'like', '%'.$value . '%');
//    }
//
//    public function searchCreate_userAttr($query, $value, $data)
//    {
//        $query->where('create_user', 'like', '%'.$value . '%');
//    }
}

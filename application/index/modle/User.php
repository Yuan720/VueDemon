<?php

/*
 * create table user
(
    userId       int auto_increment
        primary key,
    username     varchar(15) not null,
    hashedPassWd char(32)    not null,
    salt         char(16)    null
);


 * */
namespace app\index\modle;


class User extends \think\Model
{
    protected $table='user';


}

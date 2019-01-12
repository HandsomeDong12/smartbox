<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 12/31/18
 * Time: 9:08 AM
 */

namespace app\index\service;

use think\Db;

class Database
{

    public function test1()
    {
        $test = Db::query("select usernum, username from test where usernum = 18814215401 and passwd = '123yhd.'");
        return $test;
    }

    public function test2()
    {
        $test = Db::table('test')->where('usernum', 18814215401)->find();
        return $test;
    }


    public function login($param)
    {
        $data = Db::query("select username, usernum from test where usernum = '$param[usernum]' and passwd = '$param[passwd]'");

        return $data;
    }

}
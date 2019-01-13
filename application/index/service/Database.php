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
        Db::table('test');
    }


    /**
     * @param $param
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login($param)
    {
        //$data = Db::query("select username, usernum from test where usernum = '$param[usernum]' and passwd = '$param[passwd]'");

        $userNum = $param['usernum'];
        $passWd = $param['passwd'];

        $data = Db::table('test')
            ->where('usernum', $userNum)
            ->where('passwd', $passWd)
            ->field('username, usernum')->select();

        return $data;
    }

}
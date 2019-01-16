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
     * @return null|array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception
     */
    public function login($param)
    {
        //$data = Db::query("select username, usernum from test where usernum = '$param[usernum]' and passwd = '$param[passwd]'");

        $user = $param['usernum'];
        $passWd = $param['passwd'];

        $data = Db::table('test')
            ->where('usernum', $user)
            ->where('passwd', $passWd)
            ->field('username, usernum')->find();

        return $data;
    }


    /**
     * @param $user
     * @return null|array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUserData($user)
    {
        $userData = Db::table('test')
            ->where('usernum', $user)
            ->find();
        return $userData;
    }

    /**
     * @param $user
     * @return null|array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getMedicine($user)
    {
        $medicine = Db::table('medicineStatus')
            ->where('usernum', $user)
            ->field('status, name')
            ->find();

        return $medicine;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 12/31/18
 * Time: 9:08 AM
 */

namespace app\index\service;

use app\index\model\Medicine;
use app\index\model\User;
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

        $user = $param['userId'];
        $password = $param['password'];
//
//        $data = Db::table('test')
//            ->where('usernum', $user)
//            ->where('passwd', $passWd)
//            ->field('username, usernum')->find();

        $user = new User();

        $data = $user->field('userId', $user)
            ->field('password', $password)
            ->find();

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
//        $userData = Db::table('test')
//            ->where('usernum', $user)
//            ->find();

        $user = new User();

        $userData = $user->field('userId', $user)->find();

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
//        $medicine = Db::table('medicine')
//            ->where('usernum', $user)
//            ->field('status, name')
//            ->find();

        $medicine = new Medicine();

        $medicineData = $medicine->field('userId', $user)->find();

        return $medicineData;
    }

}
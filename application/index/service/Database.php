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

class Database
{
    /**
     * @param $param
     * @return null|array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception
     */
    public function login($param)
    {

        $userId = $param['userId'];
        $password = $param['password'];

        $user = new User();

        $data = $user->where('userId', $userId)
            ->where('password', $password)
            ->find();

        return $data;
    }


    /**
     * @param $userId
     * @return null|array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUserData($userId)
    {
        $user = new User();

        $userData = $user->where('userId', $userId)->find();

        return $userData;
    }

    /**
     * @param $userId
     * @return null|array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getMedicine($userId)
    {
        $user = new User();
        $medicine = new Medicine();

        $userData = $user->where('userId', $userId)->find();

        $medicineData = $medicine->where('cardId', $userData['cardId'])->find();

        return $medicineData;
    }

}
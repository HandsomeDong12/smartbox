<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 12/31/18
 * Time: 9:08 AM
 */

namespace app\service;

use app\admin\model\Box;
use app\index\model\History;
use app\index\model\Medicine;
use app\index\model\Register;
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
        $user = new User();

        $userId = $param['userId'];
        $password = $param['password'];


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
     * @return false|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getMedicine($userId)
    {
        $medicine = new Medicine();

        $medicineData = $medicine->where('phoneNumber', $userId)->select();

        return $medicineData;
    }


    /**
     * @param $userId
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function isUserIdExist($userId)
    {
        $user = new User();

        $userData = $user->where('userId', $userId)->find();
        if (is_null($userData)) {
            return false;
        } else {
            return true;
        }

    }

    public function setVerification($phoneNumber, $verification)
    {
        $register = new Register();

        $data = [
            'phoneNumber' => $phoneNumber,
            'verification' => $verification
        ];

        $register->insert($data);
    }

    /**
     * @param $phoneNumber
     * @param $verification
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function test($phoneNumber, $verification)
    {
        $register = new Register();

        if ($result = $register->where('phoneNumber', $phoneNumber)->select()) {
            return true;
        } else {
            return false;
        }

    }

    public function deleteVerification($phoneNumber)
    {
        $register = new Register();

        $register->where('phoneNumber', $phoneNumber)->delete();
    }

    /**
     * @param $phoneNumber
     * @param $verification
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function verify($phoneNumber, $verification)
    {
        $register = new Register();

        $result = $register->where('phoneNumber', $phoneNumber)
            ->where('verification', $verification)
            ->find();
        if (is_null($result)) {
            return false;
        } else {
            return true;
        }

    }

    public function addUser($params)
    {
        $user = new User();

        $data = [
            'userId' => $params['phoneNumber'],
            'password' => $params['password'],
            'userName' => $params['userName'],
            'imageUrl' => '0'
        ];

        $result = $user->insert($data);

        return $result;
    }

    public function getNullBoxes()
    {
        $box = new Box();

        $result = $box->where('status', 0)
            ->column('id');

        return $result;
    }

    /**
     * @param $verification
     * @return array|null|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function takeMedicine($verification)
    {
        $medicine = new Medicine();

        $data = $medicine
            ->where('verification', $verification)
            ->find();
        return $data;
    }


    /**
     * @param $id
     * @param $boxId
     * @return false|int
     * @throws \think\exception\DbException
     */
    public function deliverMedicine($id, $boxId)
    {
        $medicine = Medicine::get($id);

        $updateTime = time();

        $medicine['updateTime'] = $updateTime;
        $medicine['status'] = 2;
        $medicine['boxId'] = $boxId;

        $result = $medicine->save();
        return $result;
    }


    /**
     * @param $id
     * @param $verification
     * @return false|int
     * @throws \think\exception\DbException
     */
    public function updateMedicine($id, $verification)
    {
        $medicine = Medicine::get($id);

        $updateTime = time();

        $medicine['updateTime'] = $updateTime;
        $medicine['status'] = 3;
        $medicine['verification'] = $verification;


        $result = $medicine->save();
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function getBoxId($id)
    {
        $medicine = Medicine::get($id);
        return $medicine['boxId'];
    }

    /**
     * @param $id
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function getPhoneNumber($id)
    {
        $medicine = Medicine::get($id);
        $phoneNumber = $medicine['phoneNumber'];
        return $phoneNumber;
    }

    /**
     * @param $boxId
     * @param $status
     * @return false|int
     * @throws \think\exception\DbException
     */
    public function setBox($boxId, $status)
    {
        $box = Box::get($boxId);
        $box['status'] = $status;
        $result = $box->save();
        return $result;
    }

    /**
     * @param $id
     * @return int
     * @throws \think\exception\DbException
     */
    public function deleteMedicine($id)
    {
        $medicine = Medicine::get($id);
        $result = $medicine->delete();

        return $result;
    }

    /**
     * @param $id
     * @return false|int
     * @throws \think\exception\DbException
     */
    public function setHistory($id)
    {
        $medicine = Medicine::get($id);
        $history = new History();
        $history['id'] = $medicine['id'];
        $history['updateTime'] = time();
        $history['medicine'] = $medicine['medicine'];
        $history['phoneNumber'] = $medicine['phoneNumber'];
        $result = $history->save();
        return $result;
    }

    /**
     * @param $phoneNumber
     * @return false|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getHistory($phoneNumber)
    {
        $history = new History();

        $historyData = $history->where('phoneNumber', $phoneNumber)->select();

        return $historyData;

    }


}

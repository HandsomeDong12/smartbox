<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 12/31/18
 * Time: 9:08 AM
 */

namespace app\service;

use app\index\model\Medicine;
use app\index\model\Register;
use app\index\model\User;

class Database
{
    private $user;
    private $medicine;
    private $register;


    public function __construct(User $user, Medicine $medicine, Register $register)
    {
        $this->user = $user;
        $this->medicine = $medicine;
        $this->register = $register;
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

        $userId = $param['userId'];
        $password = $param['password'];


        $data = $this->user->where('userId', $userId)
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
        $userData = $this->user->where('userId', $userId)->find();

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
        $userData = $this->user->where('userId', $userId)->find();

        $medicineData = $this->medicine->where('cardId', $userData['cardId'])->find();

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
        $userData = $this->user->where('userId', $userId)->find();
        if (is_null($userData)) {
            return false;
        } else {
            return true;
        }

    }

    public function setVerification($phoneNumber, $verification)
    {
        $data = [
            'phoneNumber' => $phoneNumber,
            'verification' => $verification
        ];

        $this->register->insert($data);
    }

    public function verify($phoneNumber, $verification)
    {
        $result = $this->register->where('phoneNumber', $phoneNumber)
            ->where('verification', $verification);
        if (is_null($result)) {
            return false;
        } else {
            return true;
        }

    }

    public function addUser($params)
    {
        $data = [
            'userId' => $params['phoneNumber'],
            'cardId' => $params['cardId'],
            'password' => $params['password'],
            'userName' => $params['userName'],
            'imageUrl' => '0'
        ];

        $result = $this->user->insert($data);

        return $result;

    }


}
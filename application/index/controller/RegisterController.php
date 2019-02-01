<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 19-2-1
 * Time: 上午4:58
 */

namespace app\index\controller;


use app\service\Database;
use app\service\SmsSender;
use think\Request;

class RegisterController
{
    private $database;
    private $smsSender;

    public function __construct(Database $database, SmsSender $smsSender)
    {
        $this->database = $database;
        $this->smsSender = $smsSender;
    }

    /**
     * @param string
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private function isUserIdExist($phoneNumber)
    {
        $isExist = $this->database->isUserIdExist($phoneNumber);
        return $isExist;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function sendVerification(Request $request)
    {
        $param = $request->only(['phoneNumber']);

        $phoneNumber = $param['phoneNumber'];

        $isUserIdExist = $this->isUserIdExist($phoneNumber);


        if ($isUserIdExist) {
            $status = -1;
        } else {
            $verification = rand(1000, 9999);
            $result = $this->smsSender->sendRegisterSms($phoneNumber, $verification);
            $resultJson = json_decode($result);
            if ($resultJson->result === 0) {
                $status = 1;
                $this->database->setVerification($phoneNumber, $verification);
            } else {
                $status = 0;
            }
        }
        return ['status' => $status];
    }

    public function register(Request $request)
    {
        $params = $request->param();

        $phoneNumber = $params['phoneNumber'];
        $verification = $params['verification'];

        $params = $request->param();

        $result = $this->database->verify($phoneNumber, $verification);
        if ($result) {

            $this->database->deleteVerification($phoneNumber);
            $result = $this->database->addUser($params);
            if ($result == 1){
                $status = 1;
            }else{
                $status = 0;
            }
        } else {
            $status = -1;
        }
        return ['status' => $status];

    }


}
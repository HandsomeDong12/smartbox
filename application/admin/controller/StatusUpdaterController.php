<?php
/**
 * Created by PhpStorm.
 * User: HandsomeDong
 * Date: 2019/3/23
 * Time: 22:06
 */

namespace app\admin\controller;


use app\service\Database;
use app\service\SmsSender;
use think\Request;

class StatusUpdaterController
{
    private $database;
    private $smsSender;

    public function __construct(Database $database, SmsSender $smsSender)
    {
        $this->database = $database;
        $this->smsSender = $smsSender;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \think\exception\DbException
     */
    public function deliver(Request $request)
    {
        $params = $request->param();

        $id = $params['id'];
        $boxId = $params['boxId'];

        $result = $this->database->deliverMedicine($id, $boxId);

        return ['result' => $result];
    }

    /**
     * @param Request $request
     * @return array
     * @throws \think\exception\DbException
     */
    public function update(Request $request)
    {
        $params = $request->param();

        $id = $params['id'];

        $verification = rand(1000, 9999);

        $result  = $this->database->updateMedicine($id, $verification);

        $this->sendVerification($id, $verification);

        return ['result' => $result];

    }

    /**
     * @param $id
     * @param $verification
     * @throws \think\exception\DbException
     */
    private function sendVerification($id, $verification)
    {
        $phoneNumber = $this->database->getPhoneNumber($id);
        $this->smsSender->sendTakeMedicineSms($phoneNumber, $verification);
    }

}
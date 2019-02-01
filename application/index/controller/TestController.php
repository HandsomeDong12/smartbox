<?php

namespace app\index\controller;

use app\index\model\LoginResult;
use app\index\model\Medicine;
use app\index\model\User;
use app\service\Database;
use app\service\SmsSender;
use app\service\UserParser;
use app\index\tools\Token;
use Firebase\JWT\JWT;
use Qcloud\Sms\SmsSingleSender;
use think\Request;


class TestController extends Controller
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }


    /**
     * @param Request $request
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function test(Request $request)
    {
        $smsSender = new SmsSender();
        $result = $smsSender->sendRegisterSms("18814215401", "9999");
        return $result;
    }




}

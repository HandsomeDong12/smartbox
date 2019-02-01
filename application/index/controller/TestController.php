<?php

namespace app\index\controller;

use app\index\model\LoginResult;
use app\index\model\Medicine;
use app\index\model\User;
use app\index\service\Database;
use app\index\service\UserParser;
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
        $appid = 1400125607; // 1400开头

        $appkey = "576634af0af8af302af510047fded680";

        $phoneNumbers = ["18814215401"];
        $templateId = 276016;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

        $smsSign = "余海东个人主页";

        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = ["5678"];
            $result = $ssender->sendWithParam("86", $phoneNumbers[0], $templateId,
                $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
//            $rsp = json_decode($result);
//            echo $result;
            return $result;
        } catch(\Exception $e) {
            echo var_dump($e);
        }

    }




}

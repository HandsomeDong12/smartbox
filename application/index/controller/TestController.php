<?php

namespace app\index\controller;

use app\index\model\LoginResult;
use app\index\model\User;
use app\index\service\Database;
use app\index\service\UserParser;
use app\index\tools\Token;
use Firebase\JWT\JWT;
use think\Request;


class TestController extends Controller
{
    private $key;
    private $alg = [];

    public function __construct()
    {
        $this->key = 'YUHAIDONG';
        $this->alg = ['HS256'];
    }


    public function test(Request $request)
    {
        $param = $request->only(['token']);
        $token = $param['token'];

        $data = JWT::decode($token, $this->key, $this->alg);
        $userId = $data->uid;

        if ($userId){
            return ['status' => -1, 'message' => 'token验证失败，请重新登陆！'];
        }else{
            return ['status' => 1, 'data' => $userId];
        }
    }




}

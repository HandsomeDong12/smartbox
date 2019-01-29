<?php

namespace app\index\controller;

use app\index\model\LoginResult;
use app\index\model\Medicine;
use app\index\model\User;
use app\index\service\Database;
use app\index\service\UserParser;
use app\index\tools\Token;
use Firebase\JWT\JWT;
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
        $userParser = new UserParser();

        $param = $request->only(['token']);
        $token = $param['token'];

        $userId = $userParser->getUser($token);

        $user = new User();
        $medicine = new Medicine();

        $userData = $user->where('userId', $userId)->find();

        $medicineData = $medicine->where('cardId', $userData['cardId'])->find();


        return $userData['cardId'];

    }




}

<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/16/19
 * Time: 7:08 AM
 */

namespace app\index\controller;


use app\index\service\Database;
use think\Request;

class UserDataController extends Controller
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param Request $request
     * @return array|false|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUserData(Request $request)
    {
        $token = $request->only(['token']);
        $user = $this->getUser($token);
        $userData = $this->database->getUserData($user);
        return $user;
    }


}
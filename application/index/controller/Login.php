<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/12/19
 * Time: 9:34 AM
 */

namespace app\index\controller;

use app\index\model\LoginJson;
use app\index\service\Database;
use app\index\tools\Token;
use think\Request;

class Login
{

    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login()
    {
        $database = new Database();
        $loginJson = new LoginJson();
        $token = null;

        $request = Request::instance();
        $param = $request->param();
        $data = $database->login($param);

        if (count($data) == 0) {
            $result = $loginJson->getFailedJson();
        } else {
            $token = Token::getToken($request->param('usernum'));
            $result = $loginJson->getSuccessfulJson($token, $data);
        }
        return $result;
    }
}

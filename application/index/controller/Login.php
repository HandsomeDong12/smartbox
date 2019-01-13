<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/12/19
 * Time: 9:34 AM
 */

namespace app\index\controller;

use app\index\service\Database;
use app\index\tools\Token;
use think\Request;

class Login
{
    /**
     * @return \think\response\Json
     */
    public function login()
    {
        $database = new Database();
        $token = null;

        $request = Request::instance();
        $param = $request->param();
        $data = $database->login($param);

        if (count($data) == 0) {
            $code = 400;
            $message = 'failed';
        } else {
            $token = Token::getToken($request->param('usernum'));
            $code = 200;
            $message = 'successful';
        }
        return json(['data' => $data, 'token' => $token, 'code' => $code, 'message' => $message]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/12/19
 * Time: 9:34 AM
 */

namespace app\index\controller;

use app\index\model\LoginResult;
use app\index\service\Database;
use app\index\tools\Token;
use think\Request;

class LoginController extends Controller
{


    /**
     * @param Request $request
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception
     */
    public function login(Request $request)
    {
        $database = new Database();
        $loginJson = new LoginResult();
        $token = null;

        $param = $request->param();
        $data = $database->login($param);

        if (is_null($data)) {
            $result = $loginJson->getFailedResult();
        } else {
            $token = Token::getToken($request->param('usernum'));
            $result = $loginJson->getSuccessfulResult($token, $data);
        }
        return $result;
    }
}

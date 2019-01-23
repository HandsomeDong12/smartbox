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
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception
     */
    public function login(Request $request)
    {
        $loginJson = new LoginResult();
        $token = null;

        $param = $request->param();
        $data = $this->database->login($param);

        if (is_null($data)) {
            $result = $loginJson->getFailedResult();
        } else {
            $token = Token::getToken($request->param('userId'));
            $result = $loginJson->getSuccessfulResult($token, $data);
        }
        return $result;
    }

    /**
     * @param Request $request
     * @return array|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUserData(Request $request)
    {
        $userId = $this->getUser($request);

        $userData= $this->database->getUserData($userId);

        if (is_null($userData)) {
            return ['status' => '0'];
        }

        return ['userData' => $userData, 'status' => 1];
    }

}

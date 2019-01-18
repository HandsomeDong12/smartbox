<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/16/19
 * Time: 6:53 AM
 */

namespace app\index\controller;


use app\index\service\UserParser;
use think\Request;

class Controller
{

    /**
     * @param $request Request
     * @return mixed
     */
    protected function getUser($request)
    {
        $userParser = new UserParser();

        $param = $request->only(['token']);
        $token = $param['token'];
        $user = $userParser->getUser($token);
        return $token;
    }


}
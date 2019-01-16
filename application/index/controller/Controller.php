<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/16/19
 * Time: 6:53 AM
 */

namespace app\index\controller;


use app\index\service\UserParser;

class Controller
{

    protected function getUser($token)
    {
        $userParser = new UserParser();
        return $userParser->getUser($token);
    }


}
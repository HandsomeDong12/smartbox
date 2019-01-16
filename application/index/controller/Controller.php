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
    private $userParser;

    protected function __construct(UserParser $userParser)
    {
        $this->userParser = $userParser;
    }

    protected function getUser($token)
    {
        $user = $this->userParser->getUser($token);
        return $user;
    }


}
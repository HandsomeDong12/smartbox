<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/12/19
 * Time: 9:38 AM
 */

namespace app\index\model;


class Token
{
    public $iss;
    public $aud;
    public $iat;
    public $nbf;
    public $exp;
    public $uid;

    public $token;

    public function __construct()
    {
        $this->token = [
            "iss" => "",
            "aud" => "", //面象的用户，可以为空
            "iat" => time(), //签发时间
            "nbf" => time()+100, //在什么时候jwt开始生效  （这里表示生成100秒后才生效）
            "exp" => time()+7200, //token 过期时间
            "uid" => 123
        ];
    }

    public function getToken()
    {
        return $this->getToken();
    }

}
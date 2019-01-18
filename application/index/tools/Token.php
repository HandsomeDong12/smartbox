<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/12/19
 * Time: 11:09 PM
 */

namespace app\index\tools;


use Firebase\JWT\JWT;


/**
 * Class Token
 * @package app\index\Tools
 * The class to create a token
 */
class Token
{
    public $iss;
    public $aud;
    public $iat;
    public $nbf;
    public $exp;
    public $uid;

    public $token;

    public static function getToken($uid)
    {
        $tokenConfig = [
            "iss" => "",
            "aud" => "", //面象的用户，可以为空
            "iat" => time(), //签发时间
            "nbf" => time(), //在什么时候jwt开始生效  （这里表示生成100秒后才生效）
            "exp" => time()+720000, //token 过期时间
            "uid" => $uid
        ];
        $key = 'YUHAIDONG';

        $token = JWT::encode($tokenConfig,$key);

        return $token;
    }
}
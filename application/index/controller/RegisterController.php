<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 19-2-1
 * Time: 上午4:58
 */

namespace app\index\controller;


use think\Request;

class RegisterController
{
    public function isIdExist(Request $request)
    {
        $param = $request->only(['phone']);

    }



}
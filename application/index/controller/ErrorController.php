<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/12/19
 * Time: 8:39 AM
 */

namespace app\index\controller;


use think\Request;

class ErrorController
{
    public function index(Request $request)
    {
        $requestName = $request->controller();
        return $requestName;

    }

    protected function response($requestName)
    {
        return null;
    }
}
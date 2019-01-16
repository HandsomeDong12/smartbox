<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/16/19
 * Time: 7:08 AM
 */

namespace app\index\controller;


use think\Request;

class UserDataController extends Controller
{
    public function getUserData(Request $request)
    {
        return $request->param();
    }


}
<?php

namespace app\index\controller;

use app\index\service\Database;
use think\Request;

class Index
{


    public function index()
    {
        $testDatabase = new Database();
        $result = $testDatabase->test1();
        $test = ['name' => 'HandsomeDong', 'string' => 'is handsome'];
        return json(['data' => $result, 'code' => 200, 'message' => 'successful']);
        //return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }


    public function test()
    {
	return 'fuckfuckfuck';	
    }

    public function fuck()
    {
        return json(['message' => 'Fuck your mother!!!']);
    }

    public function login()
    {
        $database = new Database();

        $request = Request::instance();
        $param = $request->param();

        $data = $database->login($param);

        if (count($data) == 0) {
            $code = 400;
            $message = 'failed';
        } else {
            $code = 200;
            $message = 'successful';
        }

        return json(['data' => $data, 'code' => $code, 'message' => $message]);

    }
}
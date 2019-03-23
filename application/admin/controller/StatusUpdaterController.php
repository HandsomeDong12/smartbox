<?php
/**
 * Created by PhpStorm.
 * User: HandsomeDong
 * Date: 2019/3/23
 * Time: 22:06
 */

namespace app\admin\controller;


use app\service\Database;
use app\service\SmsSender;
use think\Request;

class StatusUpdaterController
{
    private $database;
    private $smsSender;

    public function __construct(Database $database, SmsSender $smsSender)
    {
        $this->database = $database;
        $this->smsSender = $smsSender;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \think\exception\DbException
     */
    public function update(Request $request)
    {
        $params = $request->param();

        $id = $params['id'];
        $status = $params['status'];

        $result = $this->database->updateMedicine($id, $status);

        return ['result' => $result];

    }

}
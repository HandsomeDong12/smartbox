<?php
/**
 * Created by PhpStorm.
 * User: HandsomeDong
 * Date: 2019/3/21
 * Time: 16:37
 */

namespace app\index\controller;


use app\service\Database;
use think\Request;

class Verification extends Controller
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getMedicine(Request $request)
    {
        $param = $request->only(['verification']);
        $verification = $param['verification'];
        $boxId = $this->database->getBoxId($verification);
        if (is_null($boxId)) {
            return [
                'status' => 1,
                'boxId' => $boxId
            ];
        } else {
            return[
                'status' => 1,
                'boxId' => $boxId
            ];
        }
    }
}
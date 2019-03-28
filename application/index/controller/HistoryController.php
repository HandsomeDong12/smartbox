<?php
/**
 * Created by PhpStorm.
 * User: HandsomeDong
 * Date: 2019/3/28
 * Time: 16:49
 */

namespace app\index\controller;


use app\service\Database;
use think\Request;

class HistoryController extends Controller
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
    public function history(Request $request)
    {
        $userId = $this->getUser($request);

        if (is_null($userId)) {
            return $this->failedVerify();
        }

        $history = $this->database->getHistory($userId);

        if (count($history) != 0) {
            return [
                'error' => 0,
                'data' => $history
            ];

        } else {
            return ['error' => 1];
        }
    }
}
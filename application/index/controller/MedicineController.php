<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/16/19
 * Time: 7:47 AM
 */

namespace app\index\controller;


use app\index\service\Database;
use think\Request;

class MedicineController extends Controller
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param Request $request
     * @return false|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getStatus(Request $request)
    {
        $user = $this->getUser($request);

        $status = $this->database->getMedicineStatus($user);

        return $status;
    }
}
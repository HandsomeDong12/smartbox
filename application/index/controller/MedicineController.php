<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/16/19
 * Time: 7:47 AM
 */

namespace app\index\controller;


use app\service\Database;
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
     * @return false|string|\think\Collection|array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getMedicine(Request $request)
    {
        $userId = $this->getUser($request);

        if (is_null($userId)){
            return $this->failedVerify();
        }

        $medicine = $this->database->getMedicine($userId);

        if (count($medicine) === 0) {
            return ['error' => 'You has no medicine'];
        }

        return $medicine;
    }
}
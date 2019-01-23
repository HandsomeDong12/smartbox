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
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getMedicine(Request $request)
    {
        $userId = $this->getUser($request);

        $medicine = $this->database->getMedicine($userId);

        if (is_null($medicine)) {
            return ['error' => 'You has no medicine'];
        }

        return $medicine;
    }
}
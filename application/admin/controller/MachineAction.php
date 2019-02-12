<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 19-2-12
 * Time: 上午6:27
 */

namespace app\admin\controller;


use app\service\Database;

class MachineAction
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getNullBoxes()
    {
        $result = $this->database->getNullBoxes();
        return ['data' => $result];
    }

}
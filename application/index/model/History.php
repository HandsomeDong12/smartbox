<?php
/**
 * Created by PhpStorm.
 * User: HandsomeDong
 * Date: 2019/3/28
 * Time: 16:35
 */

namespace app\index\model;


use think\Model;

class History extends Model
{
    public $id;
    public $updateTime;
    public $medicine;
    public $phoneNumber;
}
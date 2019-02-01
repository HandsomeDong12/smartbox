<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get('/', 'index/TestController/test');
Route::get('/login', 'index/LoginController/login');
Route::get('/user', 'index/LoginController/getUserData');
Route::get('/medicine', 'index/MedicineController/getMedicine');
Route::get('/sendverification', 'index/RegisterController/sendVerification');
Route::get('/register', 'index/RegisterController/register');



Route::get('/test', 'index/TestController/test');



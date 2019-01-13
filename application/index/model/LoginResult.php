<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/13/19
 * Time: 12:56 AM
 */

namespace app\index\model;


class LoginResult
{
    private $successfulStatus;

    private $failedStatus;

    private $successfulMessage;

    private $failedMessage;

    public function __construct()
    {
        $this->successfulStatus = 1;
        $this->failedStatus = 0;
        $this->successfulMessage = 'Successfully login!';
        $this->failedMessage = 'Error account or password, please try again!';
    }


    public function getSuccessfulResult($token, $userData)
    {
        $loginResult = array(
            'status' => $this->successfulStatus,
            'token' =>$token,
            'userData' => $userData,
            'message' => $this->successfulMessage
        );
        return $loginResult;
    }

    public function getFailedResult()
    {
        $loginResult = array(
            'status' => $this->failedStatus,
            'message' => $this->failedMessage
        );
        return $loginResult;
    }



}
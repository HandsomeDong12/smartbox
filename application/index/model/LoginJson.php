<?php
/**
 * Created by PhpStorm.
 * User: fitz
 * Date: 1/13/19
 * Time: 12:56 AM
 */

namespace app\index\model;


class LoginJson
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

    /**
     * @param $token
     * @param $userData
     * @return false|string
     */
    public function getSuccessfulJson($token, $userData)
    {
        $loginInfo = array(
            'status' => $this->successfulStatus,
            'token' =>$token,
            'userData' => $userData,
            'message' => $this->successfulMessage
        );
        $loginJson = json_encode($loginInfo);
        return $loginJson;
    }

    public function getFailedJson()
    {
        $loginInfo = array(
            'status' => $this->failedStatus,
            'message' => $this->failedMessage
        );
        $loginJson = json_encode($loginInfo);
        return $loginJson;
    }



}
<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/3
 * Time: 22:48
 */

namespace app\exception;

use yii\base\UserException;


class RpcException extends UserException
{
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
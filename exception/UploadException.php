<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/17
 * Time: 22:33
 */

namespace app\exception;

use yii\base\UserException;

class UploadException extends UserException
{
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
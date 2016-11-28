<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/10/29
 * Time: 21:51
 */

namespace app\consts;


class ErrorCode
{
    //http error code
    const SUCCESS = 200;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;

    //request error
    const INVALID_PARAM = 1000;
    const SYSTEM_ERROR = 2000;
    const ACTION_ERROR = 3000;


}
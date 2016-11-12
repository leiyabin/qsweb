<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/12
 * Time: 22:56
 */

namespace app\components;

use app\components\LSessionHandler;

class LSession
{
    public function start()
    {
        session_write_close();
        $handler = new LSessionHandler();
        session_set_save_handler($handler, true);
        session_start();
    }
}
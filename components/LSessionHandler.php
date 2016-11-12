<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/12
 * Time: 15:43
 */

namespace app\components;


use app\model\SessionModel;

class LSessionHandler implements SessionHandlerInterface
{

    public function open($save_path, $session_name)
    {
        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($session_id)
    {
        SessionModel::model()->read($session_id);
    }

    public function write($session_id, $data)
    {
        $res = SessionModel::model()->write($session_id, $data);
        if ($res) {
            return true;
        }
        return false;
    }

    public function destroy($session_id)
    {
        $res = SessionModel::model()->destroy($session_id);
        if ($res) {
            return true;
        }
        return false;
    }

    public function gc($lifetime)
    {
        $res = SessionModel::model()->gc();
        if ($res) {
            return true;
        }
        return false;
    }

}

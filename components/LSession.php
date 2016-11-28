<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/12
 * Time: 22:56
 */

namespace app\components;

use Yii;

class LSession
{
    public static function set($key, $value, $session_name)
    {
        $session = Yii::$app->session;
        $session->setName($session_name);
        $session[$key] = $value;
    }

    public static function get($key, $session_name)
    {
        $session = Yii::$app->session;
        $session->setName($session_name);
        $value = $session[$key];
        return $value;
    }

    public static function destroy($key, $session_name)
    {
        $session = Yii::$app->session;
        $session->setName($session_name);
        unset($session[$key]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:47
 */

namespace app\controllers\admin;
use app\components\LController;

class BrokerController extends LController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
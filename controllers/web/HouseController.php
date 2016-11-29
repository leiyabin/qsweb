<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:42
 */

namespace app\controllers\admin;
use app\components\LController;

class HouseController extends LController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
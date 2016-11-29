<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:43
 */

namespace app\controllers\admin;
use app\components\LController;

class LoupanController extends LController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
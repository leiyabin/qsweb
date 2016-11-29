<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:47
 */

namespace app\controllers\web;
use app\components\LController;

class OverseaController extends LController
{
    public function actionIndex()
    {
        $this->getView()->title = '千氏地产-海外';
        return $this->render('index');
    }

    public function actionMore()
    {
        $this->getView()->title = '千氏地产-海外';
        return $this->render('more');
    }
}
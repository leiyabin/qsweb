<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:47
 */

namespace app\controllers\web;
use app\components\LController;

class InformationController extends LController
{
    public function actionIndex()
    {
        $this->getView()->title = '千氏地产-房产百科';
        return $this->render('index');
    }

    public function actionDetail()
    {
        $this->getView()->title = '千氏地产-房产百科';
        return $this->render('detail');
    }
}
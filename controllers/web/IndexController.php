<?php

/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 0:53
 */
namespace app\controllers\web;

use app\components\LController;

class IndexController extends LController
{
    public function actionIndex()
    {
        $this->getView()->title = '千氏地产';
        return $this->render('index');
    }

}
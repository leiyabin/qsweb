<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:43
 */

namespace app\controllers\web;
use app\components\LController;

class LoupanController extends LController
{
    public function actionIndex()
    {
        $this->getView()->title = '千氏地产-新房';
        return $this->render('index');
    }

    public function actionDetail()
    {
        $this->getView()->title = '千氏地产-新房';
        return $this->render('detail');
    }
}
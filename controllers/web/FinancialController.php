<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:42
 */

namespace app\controllers\web;
use app\components\LController;

class FinancialController extends LController
{
    public function actionIndex()
    {
        $this->getView()->title = '千誉金融';
        return $this->render('index');
    }

    public function actionDetail()
    {
        $this->getView()->title = '千誉金融';
        return $this->render('detail');
    }
}
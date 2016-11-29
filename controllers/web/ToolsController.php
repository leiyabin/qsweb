<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:47
 */

namespace app\controllers\web;
use app\components\LController;

class ToolsController extends LController
{
    public function actionIndex()
    {
        $this->getView()->title = '千氏地产-工具';
        return $this->render('index');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/19
 * Time: 15:03
 */

namespace app\controllers\admin;

use yii\web\Controller;

class ErrorController extends Controller
{
    public $layout = false;
    public function action404()
    {
        return $this->render('404');
    }
}
<?php
namespace app\controllers\admin;

use app\components\LController;
use Yii;

/**
 * IndexController.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class IndexController extends LController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(),[

        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
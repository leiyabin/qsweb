<?php
/**
 * AuthController.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace app\controllers\admin;

use yii\web\User;
use Yii;
use app\components\LController;
use app\components\Utils;
use app\events\AdminAuthEvent;

class AuthController extends LController
{
    public $layout = false;

    /**
     * 登录
     */
    public function actionLogin()
    {
        var_dump($this->params);die;
        if (!$this->is_post) {
            return $this->render('login');
        } else {
            var_dump($this->params);die;
            if (!Utils::validVal($this->getRequestParam('username'), true)) {
                return $this->error('请输入正确的用户名！');
            }
            if (!Utils::validVal($this->getRequestParam('password'), true)) {
                return $this->error('请输入正确的密码！');
            }
            
        }
    }

    /**
     * 注销
     */
    public function actionLogout()
    {
        Yii::$app->administrator->logout();
        return $this->redirect(['login']);
    }
}
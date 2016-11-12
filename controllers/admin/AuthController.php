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

    public function init()
    {
        $eventHandler = new AdminAuthEvent();
        Yii::$app->administrator->on(User::EVENT_AFTER_LOGIN, array($eventHandler, 'onLogin'));
        Yii::$app->administrator->on(User::EVENT_AFTER_LOGOUT, array($eventHandler, 'onLogout'));
    }

    /**
     * 登录
     */
    public function actionLogin()
    {
        $request = Yii::$app->request;
        if (!$request->isPost) {
            return $this->render('login');
        } else {
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
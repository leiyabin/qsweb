<?php
/**
 * AuthController.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace app\controllers\admin;

use Yii;
use app\components\LController;
use app\components\Utils;
use app\manager\AdminManager;

class AuthController extends LController
{
    public $layout = false;
    /**
     * @var AdminManager
     */
    public $admin_manager;

    public function init()
    {
        parent::init();
        $this->admin_manager = new AdminManager();
    }

    /**
     * 登录
     */
    public function actionLogin()
    {
        if (!$this->is_post) {
            return $this->render('login');
        } else {
            if (!Utils::validVal($this->getRequestParam('username'), true)) {
                return $this->error('请输入正确的用户名！');
            }
            if (!Utils::validVal($this->getRequestParam('password'), true)) {
                return $this->error('请输入正确的密码！');
            }
        }
        $res = $this->admin_manager->login($this->params['username'], $this->params['password']);
        if ($this->hasError($res)) {
            return $this->error('登录失败！');
        } else {
            return $this->success();
        }
    }

    /**
     * 注销
     */
    public function actionLogout()
    {
        AdminManager::destroy();
        return $this->redirect(['login']);
    }
}
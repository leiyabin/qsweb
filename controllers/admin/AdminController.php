<?php
/**
 * AdministratorsController.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace app\controllers\admin;

use app\components\LController;
use app\components\Utils;
use Yii;
use app\manager\AdminManager;
use yii\data\Pagination;

class AdminController extends LController
{
    /**
     * @var AdminManager
     */
    public $admin_manager;

    public function init()
    {
        parent::init();
        $this->admin_manager = new AdminManager();
    }

    public function actionIndex()
    {
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $res = $this->admin_manager->getList($page);
        if ($this->hasError($res)) {
            $list = [];
            $pages = new Pagination(['totalCount' => 0, 'defaultPageSize' => $this->page_size]);
        } else {
            $pages = new Pagination(['totalCount' => $res->total, 'defaultPageSize' => $res->per_page]);
            $list = $res->admin;
        }
        return $this->render('index', [
            'list'  => $list,
            'pages' => $pages
        ]);
    }

    public function actionAdd()
    {
        if (!$this->is_post) {
            return $this->render('add');
        } else {
            if (!Utils::validVal($this->getRequestParam('username'), true, 0, 20)) {
                return $this->error('请输入不大于20位的用户名！');
            }
            if (!Utils::validVal($this->getRequestParam('password'), true)) {
                return $this->error('密码不能为空！');
            }
            if (!Utils::validVal($this->getRequestParam('name'), true, 0, 20)) {
                return $this->error('请输入不大于20位的姓名！');
            }
            if (!Utils::validEmail($this->params['email'])) {
                return $this->error('email格式不正确！');
            }
            if (!Utils::validPhone($this->params['phone'])) {
                return $this->error('phone格式不正确！');
            }
            $admin = [
                'username' => $this->params['username'],
                'password' => $this->params['password'],
                'name'     => $this->params['name'],
                'email'    => $this->params['email'],
                'phone'    => $this->params['phone'],
            ];
            $res = $this->admin_manager->add($admin);
            if ($this->hasError($res)) {
                return $this->error('添加用户失败！');
            } else {
                return $this->success();
            }
        }
    }

    public function actionSetpwd()
    {
        $id = $this->user_info['id'];
        if (!$this->is_post) {
            return $this->render('setpwd');
        } else {
            if (!Utils::validVal($this->getRequestParam('old_password'), true, 6)) {
                return $this->error('请输入正确的原密码！');
            }
            if (!Utils::validVal($this->getRequestParam('password'), true, 6)) {
                return $this->error('请输入正确的新密码！');
            }
            if ($this->getRequestParam('password') != $this->getRequestParam('repeat_password')) {
                return $this->error('两次密码不一致');
            }
            $res = $this->admin_manager->setPwd($id, $this->params['old_password'], $this->params['password']);
            if ($this->hasError($res)) {
                return $this->error('重置密码失败！');
            } else {
                return $this->success();
            }
        }
    }

    public function actionEdit()
    {
        $id = $this->getRequestParam('id');
        if (empty($id)) {
            return $this->render('add');
        }
        if (!$this->is_post) {
            $admin = $this->admin_manager->get($id);
            if (empty($admin)) {
                return $this->render('add');
            } else {
                return $this->render('edit', ['model' => $admin]);
            }
        } else {
            if (!Utils::validVal($this->getRequestParam('name'), true, 0, 20)) {
                return $this->error('请输入不大于20位的姓名！');
            }
            if (!Utils::validEmail($this->params['email'])) {
                return $this->error('email格式不正确！');
            }
            if (!Utils::validPhone($this->params['phone'])) {
                return $this->error('phone格式不正确！');
            }
            $admin = [
                'name'  => $this->params['name'],
                'email' => $this->params['email'],
                'phone' => $this->params['phone'],
                'id'    => $id
            ];
            if (Utils::validVal($this->getRequestParam('password'), true)) {
                $admin['password'] = $this->params['password'];
            }
            $res = $this->admin_manager->edit($admin);
            if ($this->hasError($res)) {
                return $this->error('修改用户失败！');
            } else {
                return $this->success();
            }
        }
    }

    public function actionBatchdel()
    {
        $ids = $this->getRequestParam('ids');
        if (!$ids) {
            return $this->error('请选中至少一个');
        }
        $ids = array_filter(explode(',', $ids));
        if (empty($ids)) {
            return $this->error('ids参数不合法');
        }
        $res = $this->admin_manager->batchDel($ids);
        if ($this->hasError($res)) {
            return $this->error('删除用户失败！');
        } else {
            return $this->success();
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/20
 * Time: 16:10
 */

namespace app\controllers\admin;

use app\components\LController;
use app\components\Utils;
use yii\data\Pagination;
use app\manager\BrokerManager;
use app\manager\ConfigManager;
use app\consts\ConfigConst;

class BrokerController extends LController
{
    /**
     * @var BrokerManager
     */
    public $broker_manager;
    /**
     * @var ConfigManager
     */
    public $config_manager;

    public function init()
    {
        parent::init();
        $this->broker_manager = new BrokerManager();
        $this->config_manager = new ConfigManager();
    }

    public function actionIndex()
    {
        $broker_list = [];
        $class_list = [];
        $pages = new Pagination(['totalCount' => 0, 'defaultPageSize' => $this->page_size]);
        $position_id = $this->getRequestParam('position_id', 0);
        $name = $this->getRequestParam('name', '');
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $page_info = ['page' => $page, 'pre_page' => $this->page_size];
        $res = $this->broker_manager->getList($page_info, $position_id, $name);
        if (!$this->hasError($res)) {
            $pages = new Pagination(['totalCount' => $res->total, 'defaultPageSize' => $res->per_page]);
            $broker_list = $res->broker_list;
        }
        $class_page_info = ['page' => 1, 'pre_page' => 9999];
        $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::BROKER_CLASS_CONST);
        if (!$this->hasError($res)) {
            $class_list = $res->value_list;
        }
        return $this->render('index', [
            'broker_list' => $broker_list,
            'class_list'  => $class_list,
            'pages'       => $pages,
            'position_id' => $position_id,
            'name'        => $name
        ]);
    }

    public function actionAdd()
    {
        if (!$this->is_post) {
            $list = [];
            $class_page_info = ['page' => 1, 'pre_page' => 9999];
            $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::BROKER_CLASS_CONST);
            if (!$this->hasError($res)) {
                $list = $res->value_list;
            }
            return $this->render('add', [
                'list' => $list,
            ]);
        } else {
            if (!Utils::validVal($this->getRequestParam('position_id'), true)) {
                return $this->error('请选择职位！');
            }
            if (!Utils::validVal($this->getRequestParam('name'), true, 0, 10)) {
                return $this->error('请输入不大于10字的姓名！');
            }
            if (!Utils::validVal($this->getRequestParam('phone'), true, 0, 20)) {
                return $this->error('请输入不大于20字的联系方式！');
            }
            $email = $this->getRequestParam('email');
            $img = $this->getRequestParam('img');
            $broker = [
                'position_id' => $this->params['position_id'],
                'name'        => $this->params['name'],
                'phone'       => $this->params['phone'],
                'img'         => $img,
                'email'       => $email,
            ];
            $res = $this->broker_manager->add($broker);
            if ($this->hasError($res)) {
                return $this->error('添加失败！');
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
            $broker = $this->broker_manager->get($id);
            if (empty($broker)) {
                return $this->render('add');
            } else {
                $class_list = [];
                $class_page_info = ['page' => 1, 'pre_page' => 9999];
                $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::BROKER_CLASS_CONST);
                if (!$this->hasError($res)) {
                    $class_list = $res->value_list;
                }
                $data = ['list' => $class_list, 'broker' => $broker];
                return $this->render('edit', $data);
            }
        } else {
            if (!Utils::validVal($this->getRequestParam('position_id'), true)) {
                return $this->error('请选择职位！');
            }
            if (!Utils::validVal($this->getRequestParam('name'), true, 0, 10)) {
                return $this->error('请输入不大于10字的姓名！');
            }
            if (!Utils::validVal($this->getRequestParam('phone'), true, 0, 20)) {
                return $this->error('请输入不大于20字的联系方式！');
            }
            $email = $this->getRequestParam('email');
            $img = $this->getRequestParam('img');
            $broker = [
                'position_id' => $this->params['position_id'],
                'name'        => $this->params['name'],
                'img'         => $img,
                'email'       => $email,
                'phone'       => $this->params['phone'],
                'id'          => $id,
            ];
            $res = $this->broker_manager->edit($broker);
            if ($this->hasError($res)) {
                return $this->error('修改失败！');
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
        $res = $this->broker_manager->batchDel($ids);
        if ($this->hasError($res)) {
            return $this->error('删除用户失败！');
        } else {
            return $this->success();
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/13
 * Time: 18:33
 */

namespace app\controllers\admin;

use app\components\LController;
use app\manager\ConfigManager;
use app\components\Utils;
use yii\data\Pagination;

class ConfigController extends LController
{
    /**
     * @var ConfigManager
     */
    public $config_manager;

    public function init()
    {
        parent::init();
        $this->config_manager = new ConfigManager();
    }

    public function actionClass()
    {
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $res = $this->config_manager->getClassList($page);
        if ($this->hasError($res)) {
            $list = [];
            $pages = new Pagination(['totalCount' => 0, 'defaultPageSize' => 20]);
        } else {
            $pages = new Pagination(['totalCount' => $res->total, 'defaultPageSize' => $res->per_page]);
            $list = $res->class;
        }
        return $this->render('class', [
            'list'  => $list,
            'pages' => $pages
        ]);
    }

    public function actionAddclass()
    {
        if (!$this->is_post) {
            return $this->render('addclass');
        } else {
            if (!Utils::validVal($this->getRequestParam('name'), true, 0, 20)) {
                return $this->error('请输入不大于20位的类别名称！');
            }
            $class = ['name' => $this->params['name']];
            $res = $this->config_manager->addClass($class);
            if ($this->hasError($res)) {
                return $this->error('添加类别失败！');
            } else {
                return $this->success();
            }
        }
    }


    public function actionEditclass()
    {
        $id = $this->getRequestParam('id');
        if (empty($id)) {
            return $this->render('addclass');
        }
        if (!$this->is_post) {
            $class = $this->config_manager->getClass($id);
            if (empty($class)) {
                return $this->render('add');
            } else {
                return $this->render('editclass', ['model' => $class]);
            }
        } else {
            if (!Utils::validVal($this->getRequestParam('name'), true, 0, 20)) {
                return $this->error('请输入不大于20位的类别！');
            }
            $class = [
                'name' => $this->params['name'],
                'id'   => $id
            ];
            $res = $this->config_manager->editClass($class);
            if ($this->hasError($res)) {
                return $this->error('修改类别失败！');
            } else {
                return $this->success();
            }
        }
    }

    public function actionInfo()
    {
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $res = $this->config_manager->getInfoList($page);
        if ($this->hasError($res)) {
            $list = [];
            $pages = new Pagination(['totalCount' => 0, 'defaultPageSize' => 20]);
        } else {
            $pages = new Pagination(['totalCount' => $res->total, 'defaultPageSize' => $res->per_page]);
            $list = $res->class_info;
        }
        return $this->render('info', [
            'list'  => $list,
            'pages' => $pages
        ]);
    }

    public function actionAddinfo()
    {
        if (!$this->is_post) {
            return $this->render('addinfo');
        } else {
            if (!Utils::validVal($this->getRequestParam('value'), true, 0, 50)) {
                return $this->error('请输入不大于50位的信息名称！');
            }
            if (!Utils::validVal($this->getRequestParam('class_id'), true)) {
                return $this->error('请输入选择类别id！');
            }
            $info = [
                'class_id' => $this->params['class_id'],
                'value'    => $this->params['value']
            ];
            $res = $this->config_manager->addInfo($info);
            if ($this->hasError($res)) {
                return $this->error('添加信息失败！');
            } else {
                return $this->success();
            }
        }
    }


    public function actionEditinfo()
    {
        $id = $this->getRequestParam('id');
        if (empty($id)) {
            return $this->render('addinfo');
        }
        if (!$this->is_post) {
            $info = $this->config_manager->getInfo($id);
            if (empty($info)) {
                return $this->render('addinfo');
            } else {
                return $this->render('editinfo', ['model' => $info]);
            }
        } else {
            if (!Utils::validVal($this->getRequestParam('value'), true, 0, 50)) {
                return $this->error('请输入不大于50位的信息名称！');
            }
            if (!Utils::validVal($this->getRequestParam('class_id'), true)) {
                return $this->error('请输入选择类别id！');
            }
            $info = [
                'class_id' => $this->params['class_id'],
                'value'    => $this->params['value'],
                'id'       => $this->params['id'],
            ];
            $res = $this->config_manager->editInfo($info);
            if ($this->hasError($res)) {
                return $this->error('修改信息失败！');
            } else {
                return $this->success();
            }
        }
    }
}
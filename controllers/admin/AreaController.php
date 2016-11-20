<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/20
 * Time: 14:26
 */

namespace app\controllers\admin;

use app\components\LController;
use app\components\Utils;
use yii\data\Pagination;
use app\manager\AreaManager;
use app\manager\ConfigManager;
use app\consts\ConfigConst;

class AreaController extends LController
{
    /**
     * @var AreaManager
     */
    public $area_manager;
    /**
     * @var ConfigManager
     */
    public $config_manager;

    public function init()
    {
        parent::init();
        $this->area_manager = new AreaManager();
        $this->config_manager = new ConfigManager();
    }

    public function actionIndex()
    {
        $area_list = [];
        $class_list = [];
        $pages = new Pagination(['totalCount' => 0, 'defaultPageSize' => $this->page_size]);
        $class_id = $this->getRequestParam('class_id', 0);
        $name = $this->getRequestParam('name', '');
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $page_info = ['page' => $page, 'pre_page' => $this->page_size];
        $res = $this->area_manager->getList($page_info, $class_id, $name);
        if (!$this->hasError($res)) {
            $pages = new Pagination(['totalCount' => $res->total, 'defaultPageSize' => $res->per_page]);
            $area_list = $res->area_list;
        }
        $class_page_info = ['page' => 1, 'pre_page' => 9999];
        $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::AREA_CLASS_CONST);
        if (!$this->hasError($res)) {
            $class_list = $res->value_list;
        }
        return $this->render('index', [
            'area_list'  => $area_list,
            'class_list' => $class_list,
            'pages'      => $pages,
            'class_id'   => $class_id,
            'name'      => $name
        ]);
    }

    public function actionAdd()
    {
        if (!$this->is_post) {
            $list = [];
            $class_page_info = ['page' => 1, 'pre_page' => 9999];
            $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::AREA_CLASS_CONST);
            if (!$this->hasError($res)) {
                $list = $res->value_list;
            }
            return $this->render('add', [
                'list' => $list,
            ]);
        } else {
            if (!Utils::validVal($this->getRequestParam('class_id'), true)) {
                return $this->error('请选择类别！');
            }
            if (!Utils::validVal($this->getRequestParam('name'), true, 0, 50)) {
                return $this->error('请输入不大于50位的名称！');
            }
            $area = [
                'class_id'      => $this->params['class_id'],
                'name'         => $this->params['name'],
            ];
            $res = $this->area_manager->add($area);
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
            $area = $this->area_manager->get($id);
            if (empty($area)) {
                return $this->render('add');
            } else {
                $class_list = [];
                $class_page_info = ['page' => 1, 'pre_page' => 9999];
                $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::AREA_CLASS_CONST);
                if (!$this->hasError($res)) {
                    $class_list = $res->value_list;
                }
                $data = ['list' => $class_list, 'area' => $area];
                return $this->render('edit', $data);
            }
        } else {
            if (!Utils::validVal($this->getRequestParam('class_id'), true)) {
                return $this->error('请选择类别！');
            }
            if (!Utils::validVal($this->getRequestParam('name'), true, 0, 50)) {
                return $this->error('请输入不大于20位的名称！');
            }
            $area = [
                'class_id'      => $this->params['class_id'],
                'name'         => $this->params['name'],
                'id'            => $id
            ];
            $res = $this->area_manager->edit($area);
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
        $res = $this->area_manager->batchDel($ids);
        if ($this->hasError($res)) {
            return $this->error('删除用户失败！');
        } else {
            return $this->success();
        }
    }
}
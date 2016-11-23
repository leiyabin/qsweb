<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/22
 * Time: 22:38
 */

namespace app\controllers\admin;

use app\components\LController;
use app\components\Utils;
use yii\data\Pagination;
use app\manager\LoupanManager;
use app\manager\ConfigManager;
use app\consts\ConfigConst;

class LoupanController extends LController
{
    /**
     * @var LoupanManager
     */
    public $loupan_manager;
    /**
     * @var ConfigManager
     */
    public $config_manager;

    public function init()
    {
        parent::init();
        $this->loupan_manager = new LoupanManager();
        $this->config_manager = new ConfigManager();
    }

    public function actionIndex()
    {
        //render_data
        $loupan_list = [];
        $area_list = [];
        $pages = new Pagination(['totalCount' => 0, 'defaultPageSize' => $this->page_size]);
        //select_params
        $area_id = $this->getRequestParam('area_id', 0);
        $name = $this->getRequestParam('name', '');
        $average_price = $this->getRequestParam('average_price', 0);
        $property_type_id = $this->getRequestParam('property_type_id', 0);
        $sale_status = $this->getRequestParam('sale_status', 0);
        $select_page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $select_page_info = ['page' => $select_page, 'pre_page' => $this->page_size];
        $res = $this->loupan_manager->getList($select_page_info, $area_id, $name, $average_price, $property_type_id, $sale_status);
        if (!$this->hasError($res)) {
            $pages = new Pagination(['totalCount' => $res->total, 'defaultPageSize' => $res->per_page]);
            $loupan_list = $res->loupan_list;
        }
        $class_page_info = ['page' => 1, 'pre_page' => 9999];
        $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::AREA_CLASS_CONST);
        if (!$this->hasError($res)) {
            $area_list = $res->value_list;
        }
        return $this->render('index', [
            'loupan_list'      => $loupan_list,
            'area_list'        => $area_list,
            'pages'            => $pages,
            'area_id'          => $area_id,
            'name'             => $name,
            'average_price'    => $average_price,
            'property_type_id' => $property_type_id,
            'sale_status'      => $sale_status,
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
            if (!Utils::validVal($this->getRequestParam('area_id'), true)) {
                return $this->error('请选择职位！');
            }
            if (!Utils::validVal($this->getRequestParam('name'), true, 0, 30)) {
                return $this->error('请输入不大于30的名称！');
            }
            if (!Utils::validNum($this->getRequestParam('average_price'), true)) {
                return $this->error('请输入正确均价！');
            }
            if (!Utils::validVal($this->getRequestParam('address'), true, 0, 50)) {
                return $this->error('请输入不大于50的楼盘地址！');
            }
            if (!Utils::validVal($this->getRequestParam('sale_office_address'), true, 0, 50)) {
                return $this->error('请输入不大于50的售楼处地址！');
            }
            if (!Utils::validVal($this->getRequestParam('name'), true, 0, 30)) {
                return $this->error('请输入不大于30的名称！');
            }
            if (!Utils::validVal($this->getRequestParam('phone'), true, 0, 20)) {
                return $this->error('请输入不大于20的联系方式！');
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
                return $this->error('请输入不大于10的姓名！');
            }
            if (!Utils::validVal($this->getRequestParam('phone'), true, 0, 20)) {
                return $this->error('请输入不大于20的联系方式！');
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
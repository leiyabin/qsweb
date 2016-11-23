<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/23
 * Time: 23:03
 */

namespace app\controllers\admin;

use app\components\LController;
use app\components\Utils;
use yii\data\Pagination;
use app\manager\LoupanManager;
use app\manager\ConfigManager;
use app\consts\ConfigConst;

class DoormodelController extends LController
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
        $door_model_list = [];
        if (!empty($this->params['loupan_id'])) {
            $res = $this->loupan_manager->doorModelList($this->params['loupan_id']);
            if (!$this->hasError($res)) {
                $door_model_list = $res;
//                $
            }
        }
        return $this->render('index', [
            'door_model_list' => $door_model_list,
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
            $error_msg = $this->checkLoupanParams();
            if ($error_msg) {
                $this->error($error_msg);
            }
            $loupan = $this->getLoupan();
            $res = $this->loupan_manager->add($loupan);
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
            $loupan = $this->loupan_manager->get($id);
            if (empty($loupan)) {
                return $this->render('add');
            } else {
                $class_list = [];
                $class_page_info = ['page' => 1, 'pre_page' => 9999];
                $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::AREA_CLASS_CONST);
                if (!$this->hasError($res)) {
                    $class_list = $res->value_list;
                }
                $data = ['list' => $class_list, 'loupan' => $loupan];
                return $this->render('edit', $data);
            }
        } else {
            $error_msg = $this->checkLoupanParams();
            if ($error_msg) {
                $this->error($error_msg);
            }
            $loupan = $this->getLoupan();
            $res = $this->loupan_manager->edit($loupan);
            if ($this->hasError($res)) {
                return $this->error('修改失败！');
            } else {
                return $this->success();
            }
        }
    }

    public function actionDoorModelBatchdel()
    {
        $ids = $this->getRequestParam('ids');
        if (!$ids) {
            return $this->error('请选中至少一个');
        }
        $ids = array_filter(explode(',', $ids));
        if (empty($ids)) {
            return $this->error('ids参数不合法');
        }
        $res = $this->loupan_manager->DoorModelBatchDel($ids);
        if ($this->hasError($res)) {
            return $this->error('删除户型失败！');
        } else {
            return $this->success();
        }
    }
}
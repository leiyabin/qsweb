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
use app\consts\ErrorCode;
use app\exception\RequestException;
use app\manager\LoupanManager;
use app\manager\ConfigManager;

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
        $loupan_name = '';
        if (!empty($this->params['loupan_id'])) {
            $res = $this->loupan_manager->doorModelList($this->params['loupan_id']);
            if (!$this->hasError($res)) {
                $door_model_list = $res;
                $res = $this->loupan_manager->getSimple($this->params['loupan_id']);
                if (!$this->hasError($res)) {
                    $loupan_name = $res['name'];
                }
            }
        }
        return $this->render('index', ['door_model_list' => $door_model_list, 'loupan' => $loupan_name]);
    }

    public function actionAdd()
    {
        if (!$this->is_post) {
            if (empty($this->params['loupan_id'])) {
                throw new RequestException('404', ErrorCode::NOT_FOUND);
            }
            return $this->render('add');
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
            $loupan = $this->loupan_manager->getDoorModel($id);
            if (empty($loupan)) {
                return $this->render('add');
            } else {
                $data = ['loupan' => $loupan];
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
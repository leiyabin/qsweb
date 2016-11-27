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
        $loupan_id = 0;
        if (!empty($this->params['loupan_id'])) {
            $loupan_id = $this->params['loupan_id'];
            $res = $this->loupan_manager->doorModelList($loupan_id);
            if (!$this->hasError($res)) {
                $door_model_list = $res;
                $res = $this->loupan_manager->getSimple($loupan_id);
                if (!$this->hasError($res) && !empty($res)) {
                    $loupan_name = $res->name;
                }
            }
        }
        return $this->render('index',
            ['door_model_list' => $door_model_list, 'loupan_name' => $loupan_name, 'loupan_id' => $loupan_id]);
    }

    public function actionAdd()
    {
        if (!$this->is_post) {
            if (empty($this->params['loupan_id'])) {
                throw new RequestException('404', ErrorCode::NOT_FOUND);
            }
            return $this->render('add', ['loupan_id' => $this->params['loupan_id']]);
        } else {
            if (!Utils::validNum($this->getRequestParam('loupan_id'), true)) {
                return $this->error('请选择楼盘');
            }
            $error_msg = $this->checkDoorModelParams();
            if ($error_msg) {
                return $this->error($error_msg);
            }
            $door_model = $this->getDoorModel();
            $door_model['loupan_id'] = $this->params['loupan_id'];
            $res = $this->loupan_manager->addDoorModel($door_model);
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
            $door_model = $this->loupan_manager->getDoorModel($id);
            if (empty($door_model)) {
                return $this->render('add');
            } else {
                $data = ['door_model' => $door_model];
                return $this->render('edit', $data);
            }
        } else {
            $error_msg = $this->checkDoorModelParams();
            if ($error_msg) {
                $this->error($error_msg);
            }
            $door_model = $this->getDoorModel();
            $door_model['id'] = $id;
            $res = $this->loupan_manager->editDoorModel($door_model);
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
        $res = $this->loupan_manager->doorModelBatchDel($ids);
        if ($this->hasError($res)) {
            return $this->error('删除户型失败！');
        } else {
            return $this->success();
        }
    }

    private function getDoorModel()
    {
        $door_model = [

            'face'        => $this->params['face'],
            'shitinwei'   => $this->params['shitinwei'],
            'build_area'  => $this->params['build_area'],
            'decoration'  => $this->params['decoration'],
            'img'         => $this->params['img'],
            'tag_1'       => $this->params['tag_1'],
            'tag_2'       => $this->params['tag_2'],
            'tag_3'       => $this->params['tag_3'],
            'description' => $this->params['description'],
        ];
        return $door_model;
    }

    private function checkDoorModelParams()
    {
        if (!Utils::validVal($this->getRequestParam('face'), true, 0, 10)) {
            return '请填写不大于10个字的朝向！';
        }
        if (!Utils::validVal($this->getRequestParam('shitinwei'), true, 0, 10)) {
            return '请填写不大于10个字的室厅卫情况！';
        }
        if (!Utils::validNum($this->getRequestParam('build_area'), true)) {
            return '建筑面积输入不正确！';
        }
        if (!Utils::validNum($this->getRequestParam('decoration'), true)) {
            return '请选择装修情况！';
        }
        if (!Utils::validVal($this->getRequestParam('img'), true)) {
            return '请选择上传户型图片！';
        }
        if (!Utils::validVal($this->getRequestParam('tag_1'), true)) {
            return '请填写不大于10个字的标签1！';
        }
        if (!Utils::validVal($this->getRequestParam('tag_2'), true)) {
            return '请填写不大于10个字的标签2！';
        }
        if (!Utils::validVal($this->getRequestParam('tag_3'), true)) {
            return '请填写不大于10个字的标签3！';
        }
        if (empty($this->params['description'])) {
            $this->params['description'] = '';
        }
        return '';
    }
}
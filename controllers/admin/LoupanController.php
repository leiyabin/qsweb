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
use app\consts\HouseConst;
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

        return $this->render('index', [
            'loupan_list'        => $loupan_list,
            'property_type_list' => HouseConst::$property_type,
            'name'               => $name,
            'pages'              => $pages,
            'property_type_id'   => $property_type_id,
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

    private function getLoupan()
    {
        $loupan = [
            'name'                => $this->params['name'],
            'average_price'       => $this->params['average_price'],
            'address'             => $this->params['address'],
            'sale_office_address' => $this->params['sale_office_address'],
            'opening_time'        => $this->params['opening_time'],
            'area_id'             => $this->params['area_id'],
            'property_type_id'    => $this->params['property_type_id'],
            'sale_status'         => $this->params['sale_status'],
            'jiju'                => $this->params['jiju'],
            'min_square'          => $this->params['min_square'],
            'max_square'          => $this->params['max_square'],
            'lan'                 => $this->params['lan'],
            'lat'                 => $this->params['lat'],
            'developers'          => $this->params['developers'],
            'property_company'    => $this->params['property_company'],
            'img'                 => $this->params['img'],
            'banner_img'          => $this->params['banner_img'],
            'right_time'          => $this->params['right_time'],
            'remark'              => $this->params['remark'],
            'tag'                 => $this->params['tag'],
            'img_1'               => $this->params['img_1'],
            'img_2'               => $this->params['img_2'],
            'img_3'               => $this->params['img_3'],
            'img_4'               => $this->params['img_4'],
            'img_5'               => $this->params['img_5'],
        ];
        return $loupan;
    }

    private function checkLoupanParams()
    {
        $error_msg = '';
        if (!Utils::validVal($this->getRequestParam('name'), true, 0, 30)) {
            $error_msg = '请输入不大于30字的名称！';
        }
        if (!Utils::validNum($this->getRequestParam('average_price'), true)) {
            $error_msg = '请输入正确均价！';
        }
        if (!Utils::validVal($this->getRequestParam('address'), true, 0, 50)) {
            $error_msg = '请输入不大于50字的楼盘地址！';
        }
        if (!Utils::validVal($this->getRequestParam('sale_office_address'), true, 0, 50)) {
            $error_msg = '请输入不大于50字的售楼处地址！';
        }
        if (!Utils::validNum($this->getRequestParam('opening_time'), true)) {
            $error_msg = '请选择开盘时间！';
        }
        if (!Utils::validNum($this->getRequestParam('area_id'), true)) {
            $error_msg = '请选择片区！';
        }
        if (!Utils::validNum($this->getRequestParam('property_type_id'), true)) {
            $error_msg = '请选择物业类型！';
        }
        if (!Utils::validNum($this->getRequestParam('sale_status'), true)) {
            $error_msg = '请选择售状态！';
        }
        if (!Utils::validVal($this->getRequestParam('jiju'), true, 0, 30)) {
            $error_msg = '请选择房屋居室情况！';
        }
        if (!Utils::validNum($this->getRequestParam('min_square'), true)) {
            $error_msg = '请输入最小平米数！';
        }
        if (!Utils::validNum($this->getRequestParam('max_square'), true)) {
            $error_msg = '请输入最大平米数！';
        }
        if (!empty($this->params['lan']) || !empty($this->params['lat'])) {
            $error_msg = '请选择楼盘经纬度！';
        }
        if (!Utils::validVal($this->getRequestParam('developers'), true)) {
            $error_msg = '请输入不大于50字的开发商名称！';
        }
        if (!Utils::validVal($this->getRequestParam('property_company'), true)) {
            $error_msg = '请输入不大于50字的物业名称！';
        }
        if (!Utils::validVal($this->getRequestParam('img'), true)) {
            $error_msg = '请上传楼盘封面图片！';
        }
        if (!Utils::validVal($this->getRequestParam('banner_img'), true)) {
            $error_msg = '请上传楼盘banner图片！';
        }
        if (!Utils::validNum($this->getRequestParam('right_time'), true)) {
            $error_msg = '请输入产权时间！';
        }
        if (!Utils::validVal($this->getRequestParam('remark'), false, 0, 15)) {
            $error_msg = '请输入不大于15字备注！';
        }
        if (!Utils::validVal($this->getRequestParam('img_1'), true, 0, 50)) {
            $error_msg = '请输入上传效果图1！';
        }
        if (!Utils::validVal($this->getRequestParam('img_2'), true, 0, 50)) {
            $error_msg = '请输入上传效果图2！';
        }
        if (!Utils::validVal($this->getRequestParam('img_3'), true, 0, 50)) {
            $error_msg = '请输入上传效果图3！';
        }
        if (!Utils::validVal($this->getRequestParam('img_4'), true, 0, 50)) {
            $error_msg = '请输入上传效果图4！';
        }
        if (!Utils::validVal($this->getRequestParam('img_5'), false, 0, 50)) {
            $error_msg = '请输入上传效果图5！';
        }
        if (!Utils::validVal($this->getRequestParam('tag'), true, 0, 50)) {
            $error_msg = '请选择楼盘标签！';
        }
        if (empty($this->params['remark'])) {
            $this->params['remark'] = '';
        }
        if (empty($this->params['img_5'])) {
            $this->params['img_5'] = '';
        }
        return $error_msg;
    }
}
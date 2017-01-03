<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:43
 */

namespace app\controllers\web;

use app\components\LController;
use app\consts\ConfigConst;
use app\manager\ConfigManager;
use app\manager\AreaManager;
use app\manager\LoupanManager;
use app\exception\RequestException;
use app\consts\ErrorCode;

class LoupanController extends LController
{
    /**
     * @var ConfigManager
     */
    public $config_manager;
    /**
     * @var LoupanManager
     */
    public $loupan_manager;
    /**
     * @var AreaManager
     */
    public $area_manager;

    public function init()
    {
        parent::init();
        $this->config_manager = new ConfigManager();
        $this->area_manager = new AreaManager();
        $this->loupan_manager = new LoupanManager();
    }

    public function actionIndex()
    {
        //begin get params
        $quxian_id = $this->getRequestParam('quxian_id', 0);
        $loupan_name = $this->getRequestParam('loupan_name', '');
        $area_id = $this->getRequestParam('area_id', 0);
        $price_interval = $this->getRequestParam('price_interval', '');
        $property_type_id = $this->getRequestParam('property_type_id', 0);
        $sale_status = $this->getRequestParam('sale_status', 0);
        $room_type = $this->getRequestParam('room_type', '');
        //end get params
        $quxian_list = $this->getQuxian();
        //get area
        $area_list = $this->getArea($quxian_id);
        //get recommend_list
        $recommend_list = $this->loupan_manager->getRecommend();
        //get loupan
        $total = 0;
        $pages = [];
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $page_info = ['page' => $page, 'pre_page' => $this->page_size];
        $price_interval = empty($price_interval) ? [] : explode(',', $price_interval);
        $condition = [
            'area_id'          => $area_id,
            'price_interval'   => $price_interval,
            'property_type_id' => $property_type_id,
            'room_type'        => $room_type,
            'sale_status'      => $sale_status,
            'name'             => $loupan_name,
        ];
        $order_by = ['field' => 'id', 'sort' => SORT_DESC];
        $loupan_list = $this->loupan_manager->getPageList($page_info, $condition, $order_by);
        if (!empty($loupan_list->list)) {
            $total = $loupan_list->total;
            $pages = $this->getPage($page, $loupan_list->total_pages);
            $loupan_list = $loupan_list->list;
        } else {
            $loupan_list = [];
        }
        $data = [
            'total'            => $total,
            'pages'            => $pages,
            'quxian_list'      => $quxian_list,
            'loupan_name'      => $loupan_name,
            'loupan_list'      => $loupan_list,
            'area_list'        => $area_list,
            'quxian_id'        => $quxian_id,
            'room_type'        => $room_type,
            'area_id'          => $area_id,
            'price_interval'   => $price_interval,
            'property_type_id' => $property_type_id,
            'sale_status'      => $sale_status,
            'recommend_list'   => $recommend_list,
        ];
        $this->getView()->title = '千氏地产-楼盘';
        return $this->render('index', $data);
    }

    private function getQuxian()
    {
        $quxian_list = [];
        $class_page_info = ['page' => 1, 'pre_page' => 9999];
        $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::AREA_CLASS_CONST);
        if (!$this->hasError($res)) {
            $quxian_list = $res->value_list;
            $obj = new \StdClass();
            $obj->id = 0;
            $obj->value = '不限';
            $quxian_list = array_merge([$obj], $quxian_list);
        }
        return $quxian_list;
    }

    private function getArea($quxian_id)
    {
        $page_info = ['page' => 1, 'pre_page' => 9999];
        $area_list = $this->area_manager->getList($page_info, $quxian_id);
        if (!$this->hasError($area_list)) {
            $area_list = $area_list->area_list;
            $obj = new \StdClass();
            $obj->id = 0;
            $obj->name = '全部';
            $area_list = array_merge([$obj], $area_list);
        } else {
            $area_list = [];
        }
        return $area_list;
    }

    public function actionDetail()
    {
        $id = $this->getRequestParam('id');
        if (empty($id)) {
            throw new RequestException('未找到页面，id=' . $id, ErrorCode::NOT_FOUND);
        }
        $loupan = $this->loupan_manager->get($id);
        if (empty($loupan)) {
            throw new RequestException('未找到页面，id=' . $id, ErrorCode::NOT_FOUND);
        }
        //get recommend_list
        $recommend_list = $this->loupan_manager->getRecommend();
        $this->getView()->title = '千氏地产-楼盘';
        $data = [
            'recommend_list' => $recommend_list,
            'loupan'         => $loupan
        ];
        return $this->render('detail', $data);
    }
}
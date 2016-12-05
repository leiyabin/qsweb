<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:42
 */

namespace app\controllers\web;

use app\components\LController;
use app\manager\HouseManager;
use app\manager\AreaManager;
use app\consts\ConfigConst;
use app\manager\ConfigManager;
use app\manager\LoupanManager;
use app\exception\RequestException;
use app\consts\ErrorCode;


class HouseController extends LController
{
    /**
     * @var ConfigManager
     */
    public $config_manager;
    /**
     * @var AreaManager
     */
    public $area_manager;
    /**
     * @var HouseManager
     */
    public $house_manager;
    /**
     * @var LoupanManager
     */
    public $loupan_manager;

    public function init()
    {
        parent::init();
        $this->area_manager = new AreaManager();
        $this->house_manager = new HouseManager();
        $this->config_manager = new ConfigManager();
        $this->loupan_manager = new LoupanManager();
    }

    public function actionIndex()
    {
        //begin get params
        $quxian_id = $this->getRequestParam('quxian_id', 0);
        $area_id = $this->getRequestParam('area_id', 0);
        $price_interval = $this->getRequestParam('price_interval', '');
        $area_interval = $this->getRequestParam('area_interval', '');
        $order_by = $this->getRequestParam('order_by', '');
        //end get params
        $quxian_list = $this->getQuxian();
        //get recommend_list
        $recommend_list = $this->house_manager->getRecommend();
        //get area
        $area_list = $this->getArea($quxian_id);
        $price_interval = empty($price_interval) ? [] : explode(',', $price_interval);
        $area_interval = empty($area_interval) ? [] : explode(',', $area_interval);
        //get house
        $total = 0;
        $pages = [];
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $page_info = ['page' => $page, 'pre_page' => $this->page_size];
        $house_list = $this->house_manager->getList($page_info, $area_id, $price_interval, $area_interval, 0, 0, $order_by);
        if (!empty($house_list->house_list)) {
            $total = $house_list->total;
            $pages = $this->getPage($page, $house_list->total_pages);
            $house_list = $house_list->house_list;
        } else {
            $house_list = [];
        }
        $data = [
            'total'          => $total,
            'pages'          => $pages,
            'order_by'       => $order_by,
            'house_list'     => $house_list,
            'quxian_list'    => $quxian_list,
            'quxian_id'      => $quxian_id,
            'area_list'      => $area_list,
            'area_id'        => $area_id,
            'price_interval' => $price_interval,
            'recommend_list' => $recommend_list,
            'area_interval'  => $area_interval,
        ];
        $this->getView()->title = '千氏地产-二手房';
        return $this->render('index', $data);
    }

    public function actionDetail()
    {
        $id = $this->getRequestParam('id');
        if (empty($id)) {
            throw new RequestException('未找到页面，id=' . $id, ErrorCode::NOT_FOUND);
        }
        $house = $this->house_manager->get($id);
        if (empty($house)) {
            throw new RequestException('未找到页面，id=' . $id, ErrorCode::NOT_FOUND);
        }
        //get recommend_list
        $recommend_list = $this->house_manager->getRecommend();
        $this->getView()->title = '千氏地产-二手房';
        $data = [
            'recommend_list' => $recommend_list,
            'house'         => $house
        ];
        return $this->render('detail', $data);
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

}
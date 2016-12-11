<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:47
 */

namespace app\controllers\web;

use app\components\LController;
use app\manager\BrokerManager;

class BrokerController extends LController
{
    /**
     * @var BrokerManager
     */
    public $broker_manager;

    public function init()
    {
        parent::init();
        $this->broker_manager = new BrokerManager();
    }

    public function actionIndex()
    {
        $broker_list = [];
        $pages = [];
        $position_id = $this->getRequestParam('position_id', 0);
        $name = $this->getRequestParam('name', '');
        $total = 0;
        $broker_type_interval = $this->getRequestParam('broker_type', '');
        $broker_type_interval = empty($broker_type_interval) ? [] : explode(',', $broker_type_interval);
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $page_info = ['page' => $page, 'pre_page' => $this->page_size];
        $res = $this->broker_manager->getList($page_info, $position_id, $name, $broker_type_interval);
        if (!$this->hasError($res)) {
            $total = $res->total;
            $pages = $this->getPage($page, $res->total_pages);
            $broker_list = $res->broker_list;
        }
        $this->getView()->title = '千氏地产-经纪人';
        return $this->render('index', [
            'broker_list' => $broker_list,
            'pages'       => $pages,
            'total'       => $total,
            'position_id' => $position_id,
            'name'        => $name,
            'broker_type' => $broker_type_interval
        ]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:47
 */

namespace app\controllers\web;
use app\components\LController;
use app\components\Utils;
use yii\data\Pagination;
use app\manager\BrokerManager;
use app\manager\ConfigManager;
use app\consts\ConfigConst;

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
        //todo 分页不显示的情况
        $broker_list = [];
        $pages = new Pagination(['totalCount' => 0, 'defaultPageSize' => $this->page_size]);
        $position_id = $this->getRequestParam('position_id', 0);
        $name = $this->getRequestParam('name', '');
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $page_info = ['page' => $page, 'pre_page' => $this->page_size];
        $res = $this->broker_manager->getList($page_info, $position_id, $name);
        if (!$this->hasError($res)) {
            $pages = new Pagination(['totalCount' => $res->total, 'defaultPageSize' =>1]);
            $broker_list = $res->broker_list;
        }
        $this->getView()->title = '千氏地产-经纪人';
        return $this->render('index', [
            'broker_list' => $broker_list,
            'pages'       => $pages,
            'position_id' => $position_id,
            'name'        => $name
        ]);
    }
}
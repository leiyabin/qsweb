<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:42
 */

namespace app\controllers\web;

use app\components\LController;
use app\consts\ConfigConst;
use app\consts\ErrorCode;
use app\consts\UtilsConst;
use app\exception\RequestException;
use app\manager\IntroductionManager;

class FinancialController extends LController
{
    /**
     * @var IntroductionManager
     */
    public $introduction_manager;

    public function init()
    {
        parent::init();
        $this->introduction_manager = new IntroductionManager();
    }

    public function actionIndex()
    {
        $financial_list = [];
        $pages = [];
        $total = 0;
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $page_info = ['page' => $page, 'pre_page' => $this->page_size];
        $res = $this->introduction_manager->getList($page_info, ConfigConst::FINANCIAL_CLASS_CONST);
        if (!$this->hasError($res)) {
            $total = $res->total;
            $pages = $this->getPage($page, $res->total_pages);
            $financial_list = $res->introduction_list;
        }
        $this->getView()->title = '千誉金融';
        return $this->render('index', [
            'financial_list' => $financial_list,
            'pages'          => $pages,
            'total'          => $total,
        ]);
    }

    public function actionDetail()
    {
        $id = $this->getRequestParam('id');
        if (empty($id)) {
            throw new RequestException('未找到页面，id=' . $id, ErrorCode::NOT_FOUND);
        }
        $financial = $this->introduction_manager->get($id);
        if (empty($financial)) {
            throw new RequestException('未找到页面，id=' . $id, ErrorCode::NOT_FOUND);
        }
        $data = ['financial' => $financial];
        $this->getView()->title = '千誉金融';
        return $this->render('detail', $data);
    }
}
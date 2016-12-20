<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:47
 */

namespace app\controllers\web;

use app\components\LController;
use app\consts\ConfigConst;
use app\manager\IntroductionManager;
use app\manager\NewsManager;

class OverseaController extends LController
{
    /**
     * @var IntroductionManager
     */
    public $introduction_manager;
    /**
     * @var NewsManager
     */
    public $news_manager;

    public function init()
    {
        parent::init();
        $this->introduction_manager = new IntroductionManager();
        $this->news_manager = new NewsManager();
    }

    public function actionIndex()
    {
        $information = $this->news_manager->getFewList(6, 0, ConfigConst::FINANCIAL_NEWS_CLASS);
        $this->getView()->title = '千氏地产-海外';
        $data = [
            'information_list' => $information
        ];
        return $this->render('index',$data);
    }

    public function actionMore()
    {
        $oversea = $this->introduction_manager->get(ConfigConst::OVERSEA_ID);
        $this->getView()->title = '千氏地产-海外';
        return $this->render('more', ['oversea' => $oversea]);
    }
}
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

class OverseaController extends LController
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
        $this->getView()->title = '千氏地产-海外';
        return $this->render('index');
    }

    public function actionMore()
    {
        $oversea = $this->introduction_manager->get(ConfigConst::OVERSEA_ID);
        $this->getView()->title = '千氏地产-海外';
        return $this->render('more', ['oversea' => $oversea]);
    }
}
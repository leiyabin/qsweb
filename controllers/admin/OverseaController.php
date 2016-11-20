<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/19
 * Time: 23:22
 */

namespace app\controllers\admin;

use app\components\LController;
use app\components\Utils;
use app\consts\ErrorCode;
use app\exception\RequestException;
use app\manager\IntroductionManager;
use app\manager\ConfigManager;

class OverseaController extends LController
{
    /**
     * @var IntroductionManager
     */
    public $introduction_manager;
    /**
     * @var ConfigManager
     */
    public $config_manager;

    const CLASS_ID = 10;
    const ID = 1;

    public function init()
    {
        parent::init();
        $this->introduction_manager = new IntroductionManager();
        $this->config_manager = new ConfigManager();
    }

    public function actionIndex()
    {
        if (!$this->is_post) {
            $oversea = $this->introduction_manager->get(self::ID);
            if (empty($oversea)) {
                throw new RequestException('没有找到海外房产对应的信息', ErrorCode::NOT_FOUND);
            } else {
                $data = ['oversea' => $oversea];
                return $this->render('index', $data);
            }
        } else {
            if (!Utils::validVal($this->getRequestParam('title'), true, 0, 50)) {
                return $this->error('请输入不大于50位的标题！');
            }
            if (!Utils::validVal($this->getRequestParam('content'), true)) {
                return $this->error('请输入内容！');
            }
            $oversea = [
                'class_id' => self::CLASS_ID,
                'title'    => $this->params['title'],
                'content'  => $this->params['content'],
                'id'       => self::ID
            ];
            $res = $this->introduction_manager->edit($oversea);
            if ($this->hasError($res)) {
                return $this->error('修改失败！');
            } else {
                return $this->success();
            }
        }
    }

}
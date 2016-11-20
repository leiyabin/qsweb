<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/20
 * Time: 11:14
 */

namespace app\controllers\admin;

use app\components\LController;
use app\components\Utils;
use app\consts\ErrorCode;
use app\exception\RequestException;
use app\manager\IntroductionManager;
use app\manager\ConfigManager;
use yii\data\Pagination;

class FinancialController extends LController
{
    /**
     * @var IntroductionManager
     */
    public $introduction_manager;
    /**
     * @var ConfigManager
     */
    public $config_manager;

    const CLASS_ID = 11;

    public function init()
    {
        parent::init();
        $this->introduction_manager = new IntroductionManager();
        $this->config_manager = new ConfigManager();
    }

    public function actionIndex()
    {
        $financial_list = [];
        $pages = new Pagination(['totalCount' => 0, 'defaultPageSize' => $this->page_size]);
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $page_info = ['page' => $page, 'pre_page' => $this->page_size];
        $res = $this->introduction_manager->getList($page_info, self::CLASS_ID);
        if (!$this->hasError($res)) {
            $pages = new Pagination(['totalCount' => $res->total, 'defaultPageSize' => $res->per_page]);
            $financial_list = $res->introduction_list;
        }
        return $this->render('index', [
            'financial_list' => $financial_list,
            'pages'          => $pages,
        ]);
    }

    public function actionEdit()
    {
        $id = $this->getRequestParam('id');
        if (empty($id)) {
            return $this->render('add');
        }
        if (!$this->is_post) {
            $financial = $this->introduction_manager->get($id);
            if (empty($financial)) {
                return $this->render('add');
            } else {
                $data = ['financial' => $financial];
                return $this->render('index', $data);
            }
        } else {
            if (!Utils::validVal($this->getRequestParam('title'), true, 0, 50)) {
                return $this->error('请输入不大于50位的标题！');
            }
            if (!Utils::validVal($this->getRequestParam('content'), true)) {
                return $this->error('请输入内容！');
            }
            $financial = [
                'class_id' => self::CLASS_ID,
                'title'    => $this->params['title'],
                'content'  => $this->params['content'],
                'id'       => $id
            ];
            $res = $this->introduction_manager->edit($financial);
            if ($this->hasError($res)) {
                return $this->error('修改失败！');
            } else {
                return $this->success();
            }
        }
    }

    public function actionAdd()
    {
        if (!$this->is_post) {
            return $this->render('add');
        } else {
            if (!Utils::validVal($this->getRequestParam('title'), true, 0, 50)) {
                return $this->error('请输入不大于50位的标题！');
            }
            if (!Utils::validVal($this->getRequestParam('content'), true)) {
                return $this->error('请输入内容！');
            }
            $financial = [
                'class_id'      => self::CLASS_ID,
                'title'         => $this->params['title'],
                'content'       => $this->params['content'],
            ];
            $res = $this->introduction_manager->add($financial);
            if ($this->hasError($res)) {
                return $this->error('添加失败！');
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
        $res = $this->news_manager->batchDel($ids);
        if ($this->hasError($res)) {
            return $this->error('删除用户失败！');
        } else {
            return $this->success();
        }
    }

}
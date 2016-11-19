<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/15
 * Time: 22:49
 */

namespace app\controllers\admin;

use app\components\LController;
use app\components\Utils;
use yii\data\Pagination;
use app\manager\NewsManager;
use app\manager\ConfigManager;
use app\consts\ConfigConst;

class NewsController extends LController
{
    /**
     * @var NewsManager
     */
    public $news_manager;
    /**
     * @var ConfigManager
     */
    public $config_manager;

    public function init()
    {
        parent::init();
        $this->news_manager = new NewsManager();
        $this->config_manager = new ConfigManager();
    }

    public function actionList()
    {
        $news_list = [];
        $class_list = [];
        $pages = new Pagination(['totalCount' => 0, 'defaultPageSize' => $this->page_size]);
        $class_id = $this->getRequestParam('class_id', 0);
        $title = $this->getRequestParam('title', '');
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $page_info = ['page' => $page, 'pre_page' => $this->page_size];
        $res = $this->news_manager->getNewsList($page_info, $class_id, $title);
        if (!$this->hasError($res)) {
            $pages = new Pagination(['totalCount' => $res->total, 'defaultPageSize' => $res->per_page]);
            $news_list = $res->news_list;
        }
        $class_page_info = ['page' => 1, 'pre_page' => 9999];
        $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::NEWS_CLASS_CONST);
        if (!$this->hasError($res)) {
            $class_list = $res->value_list;
        }
        return $this->render('index', [
            'news_list'  => $news_list,
            'class_list' => $class_list,
            'pages'      => $pages,
            'class_id'   => $class_id,
            'title'      => $title
        ]);
    }

    public function actionAdd()
    {
        if (!$this->is_post) {
            $list = [];
            $class_page_info = ['page' => 1, 'pre_page' => 9999];
            $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::NEWS_CLASS_CONST);
            if (!$this->hasError($res)) {
                $list = $res->value_list;
            }
            return $this->render('add', [
                'list' => $list,
            ]);
        } else {
            if (!Utils::validVal($this->getRequestParam('class_id'), true)) {
                return $this->error('请选择类别！');
            }
            if (!Utils::validVal($this->getRequestParam('title'), true, 0, 50)) {
                return $this->error('请输入不大于50位的标题！');
            }
            if (!Utils::validVal($this->getRequestParam('news_content'), true)) {
                return $this->error('请输入内容！');
            }
            $hot_img = $this->getRequestParam('hot_img');
            $recommend_img = $this->getRequestParam('recommend_img');
            $img = $this->getRequestParam('img');
            $news = [
                'class_id'      => $this->params['class_id'],
                'title'         => $this->params['title'],
                'content'       => $this->params['news_content'],
                'hot'           => 0,
                'recommend'     => 0,
                'hot_img'       => '',
                'recommend_img' => '',
                'img'           => '',
            ];
            if (!empty($hot_img)) {
                $news['hot_img'] = $hot_img;
                $news['hot'] = 1;
            }
            if (!empty($recommend_img)) {
                $news['recommend_img'] = $recommend_img;
                $news['recommend'] = 1;
            }
            if (!empty($img)) {
                $news['img'] = $img;
            }
            $res = $this->news_manager->add($news);
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
            $news = $this->news_manager->get($id);
            if (empty($news)) {
                return $this->render('add');
            } else {
                $class_list = [];
                $class_page_info = ['page' => 1, 'pre_page' => 9999];
                $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::NEWS_CLASS_CONST);
                if (!$this->hasError($res)) {
                    $class_list = $res->value_list;
                }
                $data = ['list' => $class_list, 'news' => $news];
                return $this->render('edit', $data);
            }
        } else {
            if (!Utils::validVal($this->getRequestParam('value'), true, 0, 50)) {
                return $this->error('请输入不大于50位的信息名称！');
            }
            if (!Utils::validVal($this->getRequestParam('class_id'), true)) {
                return $this->error('请输入选择类别id！');
            }
            $info = [
                'class_id' => $this->params['class_id'],
                'value'    => $this->params['value'],
                'id'       => $this->params['id'],
            ];
            $res = $this->config_manager->editInfo($info);
            if ($this->hasError($res)) {
                return $this->error('修改信息失败！');
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
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
//        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
//        $page_info = ['page' => $page, 'pre_page' => $this->page_size];
//        $res = $this->news_manager->getNewsList($page_info, $class_id, $title);
//        if (!$this->hasError($res)) {
//            $pages = new Pagination(['totalCount' => $res->total, 'defaultPageSize' => $res->per_page]);
//            $news_list = $res->news_list;
//        }
//        $class_page_info = ['page' => 1, 'pre_page' => 9999];
//        $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::NEWS_CLASS_CONST);
//        if (!$this->hasError($res)) {
//            $class_list = $res->value_list;
//        }
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
            //todo 保存图片，返回保存地址
            $top_img = $this->getRequestParam('top_img');
            $recommend_img = $this->getRequestParam('recommend_img');
            $news_img = $this->getRequestParam('news_img');
            $news = [
                'class_id' => $this->params['class_id'],
                'title'    => $this->params['title'],
                'content'  => $this->params['news_content'],
            ];
            if (!empty($top_img)){
                $news['top_img'] = $top_img;
            }
            if (!empty($recommend_img)){
                $news['recommend_img'] = $top_img;
            }
            if (!empty($news_img)){
                $news['news_img'] = $top_img;
            }
            $res = $this->news_manager->add($news);
            if ($this->hasError($res)) {
                return $this->error('添加失败！');
            } else {
                return $this->success();
            }
        }
    }


    public function actionEditinfo()
    {
        $id = $this->getRequestParam('id');
        if (empty($id)) {
            return $this->render('add');
        }
        if (!$this->is_post) {
            $info = $this->news_manager->get($id);
            if (empty($info)) {
                return $this->render('add');
            } else {
                $class_list = [];
                $res = $this->config_manager->getClassList(1, 9999);
                if (!$this->hasError($res)) {
                    $class_list = $res->class_list;
                }
                $data = ['class_list' => $class_list, 'info' => $info];
                return $this->render('editinfo', $data);
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
}
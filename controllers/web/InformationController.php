<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 9:47
 */

namespace app\controllers\web;

use app\components\LController;
use app\manager\NewsManager;
use app\manager\ConfigManager;
use app\consts\ConfigConst;
use app\exception\RequestException;
use app\consts\ErrorCode;

class InformationController extends LController
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

    public function actionIndex()
    {
        $total = 0;
        $news_list = [];
        $class_list = [];
        $pages = [];
        $class_id = $this->getRequestParam('class_id', 0);
        $page = empty($this->params['page']) ? $this->default_page : $this->params['page'];
        $page_info = ['page' => $page, 'pre_page' => $this->page_size];
        //分类查询
        $res = $this->news_manager->getNewsList($page_info, $class_id);
        if (!$this->hasError($res)) {
            $total = $res->total;
            $pages = $this->getPage($page, $res->total_pages);
            $news_list = $res->news_list;
        }
        $top_img_list = $news_list;
        //查询总的top5
        $page_info = ['page' => 1, 'pre_page' => 5];
        $top_5_list = $this->news_manager->getNewsList($page_info);
        if (!$this->hasError($top_5_list)) {
            $top_5_list = $top_5_list->news_list;
            $top_img_list = $top_5_list;
        }
        //class
        $class_page_info = ['page' => 1, 'pre_page' => 9999];
        $res = $this->config_manager->getInfoList($class_page_info, ConfigConst::NEWS_CLASS_CONST);
        if (!$this->hasError($res)) {
            $class_list = $res->value_list;
        }
        $this->getView()->title = '千氏地产-房产百科';
        $left_img_list = [];
        $news_4 = $news_5 = [];
        for ($i = 0; $i < 5; $i++) {
            if (isset($top_img_list[$i])) {
                if ($i < 3) {
                    $left_img_list[] = $top_img_list[$i];
                } elseif ($i == 3) {
                    $news_4 = $top_img_list[$i];
                } elseif ($i == 4) {
                    $news_5 = $top_img_list[$i];
                }
            }
        }
        return $this->render('index', [
            'news_list'     => $news_list,
            'class_list'    => $class_list,
            'pages'         => $pages,
            'class_id'      => $class_id,
            'total'         => $total,
            'news_4'        => $news_4,
            'news_5'        => $news_5,
            'left_img_list' => $left_img_list,
        ]);
    }

    public function actionDetail()
    {
        $id = $this->getRequestParam('id');
        if (empty($id)) {
            throw new RequestException('未找到页面，id=' . $id, ErrorCode::NOT_FOUND);
        }
        $news = $this->news_manager->get($id);
        if (empty($news)) {
            throw new RequestException('未找到页面，id=' . $id, ErrorCode::NOT_FOUND);
        }
        $data = ['news' => $news];
        $this->getView()->title = '千氏地产-房产百科';
        return $this->render('detail', $data);
    }
}
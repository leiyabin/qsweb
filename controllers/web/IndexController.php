<?php

/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/29
 * Time: 0:53
 */
namespace app\controllers\web;

use app\components\LController;
use app\manager\NewsManager;
use app\manager\LoupanManager;

class IndexController extends LController
{
    const NEWS_TAG_HOT = 1;
    const NEWS_TAG_RECOMMEND = 2;
    /**
     * @var NewsManager
     */
    public $news_manager;
    /**
     * @var LoupanManager
     */
    public $loupan_manager;

    public function init()
    {
        parent::init();
        $this->news_manager = new NewsManager();
        $this->loupan_manager = new LoupanManager();
    }

    public function actionIndex()
    {
        //楼市热点
        $news_hot_list = $this->getInformation(self::NEWS_TAG_HOT, 5);
        //第一条新闻
        $top_hot_news = [];
        if (!empty($news_hot_list)) {
            $top_hot_news = current($news_hot_list);
            array_shift($news_hot_list);
        }
        //帮你买房
        $news_help_list = $this->getInformation(self::NEWS_TAG_RECOMMEND, 2);
        //get recommend_list
        $recommend_list = $this->getRecommend();
        $data = [
            'news_hot_list'  => $news_hot_list,
            'news_help_list' => $news_help_list,
            'top_hot_news'   => $top_hot_news,
            'recommend_list' => $recommend_list,
        ];
        $this->getView()->title = '千氏地产';
        return $this->render('index', $data);
    }

    private function getInformation($tag, $size)
    {
        $page_info = ['page' => 1, 'pre_page' => $size];
        $list = $this->news_manager->getNewsList($page_info, 0, '', $tag);
        if (!$this->hasError($list)) {
            $list = $list->news_list;
        } else {
            $list = [];
        }
        return $list;
    }

    private function getRecommend()
    {
        $page_info = ['page' => 1, 'pre_page' => 2];
        $list = $this->loupan_manager->getList($page_info, 0, '', 0, 0, 0, 1);
        if (!$this->hasError($list)) {
            $list = $list->loupan_list;
        } else {
            $list = [];
        }
        return $list;
    }

}
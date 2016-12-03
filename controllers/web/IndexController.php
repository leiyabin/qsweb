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
use app\manager\ConfigManager;
use app\consts\ConfigConst;
use app\exception\RequestException;
use app\consts\ErrorCode;
use app\model\SessionModel;

class IndexController extends LController
{
    const NEWS_TAG_HOT = 1;
    const NEWS_TAG_RECOMMEND = 2;
    /**
     * @var NewsManager
     */
    public $news_manager;

    public function init()
    {
        parent::init();
        $this->news_manager = new NewsManager();
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
        $data = [
            'news_hot_list'  => $news_hot_list,
            'news_help_list' => $news_help_list,
            'top_hot_news'   => $top_hot_news];
        $this->getView()->title = '千氏地产';
        return $this->render('index', $data);
    }

    private function getInformation($tag, $size)
    {
        $page_info = ['page' => 1, 'pre_page' => $size];
        $list = $this->news_manager->getNewsList($page_info, 0, '', $tag);
        if (!empty($list)) {
            return $list->news_list;
        }
        return [];
    }

}
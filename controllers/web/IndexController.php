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
use app\manager\HouseManager;
use app\manager\LoupanManager;
use app\manager\StatisticsManager;

class IndexController extends LController
{
    const NEWS_TAG_HOT = 1;
    const NEWS_TAG_RECOMMEND = 2;
    /**
     * @var HouseManager
     */
    public $house_manager;
    /**
     * @var StatisticsManager
     */
    public $statistics_manager;
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
        $this->house_manager = new HouseManager();
        $this->statistics_manager = new StatisticsManager();
    }

    public function actionIndex()
    {
        //楼市热点
        $news_hot_list = $this->getInformation(5, self::NEWS_TAG_HOT);
        //第一条新闻
        $top_hot_news = [];
        if (!empty($news_hot_list)) {
            $top_hot_news = current($news_hot_list);
            array_shift($news_hot_list);
        }
        //帮你买房
        $news_help_list = $this->getInformation(2, self::NEWS_TAG_RECOMMEND);
        //get recommend_list
        $recommend_list = $this->getRecommend();

        //get house recommend_list
        $house_recommend_list = $this->house_manager->getRecommend();
        //get statistics data
        $statistics_data = $this->statistics_manager->get();
        $data = [
            'news_hot_list'        => $news_hot_list,
            'news_help_list'       => $news_help_list,
            'top_hot_news'         => $top_hot_news,
            'recommend_list'       => $recommend_list,
            'house_recommend_list' => $house_recommend_list,
            'statistics_data'      => $statistics_data
        ];
        $this->getView()->title = '千氏地产官网';
        return $this->render('index', $data);
    }

    private function getInformation($size, $tag)
    {
        $list = $this->news_manager->getFewList($size, $tag);
        if ($this->hasError($list)) {
            $list = [];
        }
        return $list;
    }

    private function getRecommend()
    {
        $page_info = ['page' => 1, 'pre_page' => 2];
        $list = $this->loupan_manager->getList($page_info, 0, '', 0, 0, 0, 1);
        if (!empty($list)) {
            $list = $list->loupan_list;
        } else {
            $list = [];
        }
        return $list;
    }

}
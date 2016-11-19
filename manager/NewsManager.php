<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/15
 * Time: 22:50
 */

namespace app\manager;


use app\components\Utils;
use app\rpc\NewsRpc;

class NewsManager
{
    public $news_rpc;

    public function __construct()
    {
        $this->news_rpc = new NewsRpc();
    }

    public function getNewsList($page_info, $class_id = 0, $title = '')
    {
        return $this->news_rpc->getList($page_info, $class_id, $title);
    }

    public function add($news)
    {
        $content = $news['content'];
        $news['summary'] = $this->getSummary($content);
        return $this->news_rpc->add($news);
    }

    public function edit($news)
    {
        $content = $news['content'];
        $news['summary'] = $this->getSummary($content);
        return $this->news_rpc->edit($news);
    }

    public function get($id)
    {
        $res = $this->news_rpc->getOne($id);
        if (!empty($res)) {
            $res->img_url = Utils::getImgUrl($res->img);
            $res->hot_img_url = Utils::getImgUrl($res->hot_img);
            $res->recommend_img_url = Utils::getImgUrl($res->recommend_img);
        }
        return $res;
    }


    public function batchDel($ids)
    {
        return $this->news_rpc->batchDel($ids);
    }

    private function getSummary($content)
    {
        $summary = strip_tags($content);
        $summary = substr($summary, 0, 150);
        return $summary;
    }
}
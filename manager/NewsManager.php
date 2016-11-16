<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/15
 * Time: 22:50
 */

namespace app\manager;


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
        return '';
    }

    public function add($news)
    {
        $content = $news['content'];
        $summary = strip_tags($content);
        $summary = substr($summary, 0, 150);
        $news['summary'] = $summary;
        return $this->news_rpc->add($news);
    }

    public function editInfo($info)
    {
        return $this->news_rpc->edit($info);
    }

    public function getInfo($id)
    {
        return $this->news_rpc->getOne($id);
    }
}
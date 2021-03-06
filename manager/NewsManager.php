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

    public function getNewsList($page_info, $class_id = 0, $title = '', $tag = 0)
    {
        $list = $this->news_rpc->getList($page_info, $class_id, $title, $tag);
        if (!empty($list->news_list)) {
            foreach ($list->news_list as $key => $item) {
                $list->news_list[$key]->img_url = Utils::getImgUrl($item->img);
                $list->news_list[$key]->hot_img_url = Utils::getImgUrl($item->hot_img);
                $list->news_list[$key]->recommend_img_url = Utils::getImgUrl($item->recommend_img);
            }
            return $list;
        }
        return [];
    }


    public function get($id)
    {
        $res = $this->news_rpc->getOne($id);
        if (!empty($res->id)) {
            $res->img_url = Utils::getImgUrl($res->img);
            $res->hot_img_url = Utils::getImgUrl($res->hot_img);
            $res->recommend_img_url = Utils::getImgUrl($res->recommend_img);
            return $res;
        }
        return [];
    }

    public function getFewList($limit, $tag = 0, $class_id = 0)
    {
        $list = $this->news_rpc->getFewList($limit, $tag, $class_id);
        if (!empty($list)) {
            foreach ($list as $key => $item) {
                $list[$key]->img_url = Utils::getImgUrl($item->img);
                $list[$key]->hot_img_url = Utils::getImgUrl($item->hot_img);
                $list[$key]->recommend_img_url = Utils::getImgUrl($item->recommend_img);
            }
            return $list;
        }
        return [];
    }

}
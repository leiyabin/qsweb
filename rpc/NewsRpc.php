<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/15
 * Time: 22:51
 */

namespace app\rpc;

use app\components\LRpc;

class NewsRpc extends LRpc
{
    public function getList($page_info, $class_id = 0, $title = '')
    {
        $params = [
            'page'     => intval($page_info['page']),
            'per_page' => intval($page_info['pre_page']),
            'class_id' => $class_id,
            'title'    => $title
        ];
        return LRpc::init()->post($params)->url('/news/list');
    }

    public function add($news)
    {
        $params = $news;
        return LRpc::init()->post($params)->url('/news/add');
    }

    public function edit($news)
    {
        $params = $news;
        return LRpc::init()->post($params)->url('/news/edit');
    }

    public function batchDel($ids)
    {
        $params = ['ids' => $ids];
        return LRpc::init()->post($params)->url('/news/batchdel');
    }

    public function getOne($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/news/get');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/19
 * Time: 23:50
 */

namespace app\rpc;


use app\components\LRpc;

class IntroductionRpc extends LRpc
{
    public function get($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/introduction/get');
    }

    public function add($introduction)
    {
        $params = $introduction;
        return LRpc::init()->post($params)->url('/introduction/add');
    }

    public function edit($introduction)
    {
        $params = $introduction;
        return LRpc::init()->post($params)->url('/introduction/edit');
    }

    public function getList($page_info, $class_id = 0)
    {
        $params = [
            'page'     => intval($page_info['page']),
            'per_page' => intval($page_info['pre_page']),
            'class_id' => $class_id,
        ];
        return LRpc::init()->post($params)->url('/introduction/getlist');
    }

    public function batchDel($ids)
    {
        $params = ['ids' => $ids];
        return LRpc::init()->post($params)->url('/introduction/batchdel');
    }
}
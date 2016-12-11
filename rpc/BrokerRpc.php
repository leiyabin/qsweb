<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/20
 * Time: 15:54
 */

namespace app\rpc;

use app\components\LRpc;

class BrokerRpc extends LRpc
{
    public function getList($page_info, $position_id = 0, $name = '', $broker_type_interval = [])
    {
        $params = [
            'page'        => intval($page_info['page']),
            'per_page'    => intval($page_info['pre_page']),
            'position_id' => $position_id,
            'name'        => $name,
            'broker_type' => $broker_type_interval
        ];
        return LRpc::init()->post($params)->url('/broker/list');
    }

    public function add($broker)
    {
        $params = $broker;
        return LRpc::init()->post($params)->url('/broker/add');
    }

    public function edit($broker)
    {
        $params = $broker;
        return LRpc::init()->post($params)->url('/broker/edit');
    }

    public function batchDel($ids)
    {
        $params = ['ids' => $ids];
        return LRpc::init()->post($params)->url('/broker/batchdel');
    }

    public function getOne($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/broker/get');
    }
}
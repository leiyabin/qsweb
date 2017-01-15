<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/20
 * Time: 14:28
 */

namespace app\rpc;

use app\components\LRpc;

class AreaRpc extends LRpc
{
    public function getList($page_info, $class_id = 0, $name = '', $is_trip_area)
    {
        $params = [
            'page'         => intval($page_info['page']),
            'per_page'     => intval($page_info['pre_page']),
            'class_id'     => $class_id,
            'name'         => $name,
            'is_trip_area' => $is_trip_area
        ];
        return LRpc::init()->post($params)->url('/area/list');
    }

    public function add($area)
    {
        $params = $area;
        return LRpc::init()->post($params)->url('/area/add');
    }

    public function edit($area)
    {
        $params = $area;
        return LRpc::init()->post($params)->url('/area/edit');
    }

    public function batchDel($ids)
    {
        $params = ['ids' => $ids];
        return LRpc::init()->post($params)->url('/area/batchdel');
    }

    public function getOne($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/area/get');
    }

    public function getByClassId($class_id)
    {
        $params = ['class_id' => $class_id];
        return LRpc::init()->post($params)->url('/area/getbyclassid');
    }
}
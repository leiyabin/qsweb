<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/22
 * Time: 22:41
 */

namespace app\rpc;

use app\components\LRpc;

class LoupanRpc extends LRpc
{
    /**
     * @param $page_info
     * @param int $area_id
     * @param string $name
     * @param int $average_price
     * @param int $property_type_id
     * @param int $sale_status
     * @return LRpc
     */
    public function getList($page_info, $area_id = 0, $name = '', $average_price = 0,
                            $property_type_id = 0, $sale_status = 0, $recommend = 0)
    {
        $params = [
            'page'             => intval($page_info['page']),
            'per_page'         => intval($page_info['pre_page']),
            'area_id'          => $area_id,
            'name'             => $name,
            'average_price'    => $average_price,
            'property_type_id' => $property_type_id,
            'sale_status'      => $sale_status,
            'recommend'        => $recommend
        ];
        return LRpc::init()->post($params)->url('/loupan/list');
    }

    public function add($loupan)
    {
        $params = $loupan;
        return LRpc::init()->post($params)->url('/loupan/add');
    }

    public function edit($loupan)
    {
        $params = $loupan;
        return LRpc::init()->post($params)->url('/loupan/edit');
    }

    public function getOne($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/loupan/get');
    }

    public function getSimple($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/loupan/getsimple');
    }

    public function active($id, $active)
    {
        $params = ['id' => $id, 'active' => $active];
        return LRpc::init()->post($params)->url('/loupan/active');
    }

    public function doorModelList($loupan_id)
    {
        $params = ['loupan_id' => $loupan_id];
        return LRpc::init()->post($params)->url('/doormodel/list');
    }

    public function doorModelBatchDel($ids)
    {
        $params = ['ids' => $ids];
        return LRpc::init()->post($params)->url('/doormodel/batchdel');
    }

    public function doorModelGet($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/doormodel/get');
    }

    public function doorModelEdit($door_model)
    {
        $params = $door_model;
        return LRpc::init()->post($params)->url('/doormodel/edit');
    }

    public function doorModelAdd($door_model)
    {
        $params = $door_model;
        return LRpc::init()->post($params)->url('/doormodel/add');
    }
}
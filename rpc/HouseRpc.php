<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/12/4
 * Time: 18:37
 */

namespace app\rpc;

use app\components\LRpc;

class HouseRpc extends LRpc
{
    public function get($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/house/get');
    }

    public function getList($page_info, $area_id = 0, $price_interval = 0, $build_area = [],
                            $property_type_id = 0, $recommend = 0, $order_by)
    {
        $params = [
            'page'             => intval($page_info['page']),
            'per_page'         => intval($page_info['pre_page']),
            'area_id'          => $area_id,
            'price_interval'   => $price_interval,
            'build_area'       => $build_area,
            'property_type_id' => $property_type_id,
            'recommend'        => $recommend,
            'order_by'         => $order_by
        ];
        return LRpc::init()->post($params)->url('/house/list');
    }

    public function getRecommend($size)
    {
        $params = [
            'size'      => $size,
        ];
        return LRpc::init()->post($params)->url('/house/getrecommend');
    }
}
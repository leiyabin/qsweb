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

    /**
     * @param $page_info
     * @param $condition [area_id，price_interval，build_area，property_type_id，address，school_info];
     * @param $order_by
     * @return LRpc
     */
    public function getPageList($page_info, $condition, $order_by)
    {
        $params = [
            'page'             => intval($page_info['page']),
            'per_page'         => intval($page_info['pre_page']),
            'area_id'          => $condition['area_id'],
            'price_interval'   => $condition['price_interval'],
            'build_area'       => $condition['build_area'],
            'property_type_id' => $condition['property_type_id'],
            'room_type'        => $condition['room_type'],
            'school_info'      => $condition['school_info'],
            'address'          => $condition['address'],
            'order_by'         => $order_by['field'],
            'sort'             => $order_by['sort'],
        ];
        return LRpc::init()->post($params)->url('/house/list');
    }

    public function getRecommend($size)
    {
        $params = [
            'size' => $size,
        ];
        return LRpc::init()->post($params)->url('/house/getrecommend');
    }
}